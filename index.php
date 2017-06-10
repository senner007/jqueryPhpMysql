<?php
// echo PHP_VERSION;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajax Add/Delete a Record with jQuery Fade In/Fade Out</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

	//##### send add record Ajax request to response.php #########
	$("#FormSubmit").click(function (e) {
			e.preventDefault();
			if($("#contentText").val()==='')
			{
				alert("Please enter some text!");
				return false;
			}

			$("#FormSubmit").hide(); //hide submit button
			$("#LoadingImage").show(); //show loading image

		 	var myData = 'content_txt='+ $("#contentText").val(); //build a post data structure
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "response.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				console.log(response)
				$("#responds").append(response);
				$("#contentText").val(''); //empty text field on successful
				$("#FormSubmit").show(); //show submit button
				$("#LoadingImage").hide(); //hide loading image

			},
			error:function (xhr, ajaxOptions, thrownError){
				$("#FormSubmit").show(); //show submit button
				$("#LoadingImage").hide(); //hide loading image
				alert(thrownError);
			}
			});
	});
	
	$("#loginSubmit").click(function (e) {					// add login here
			e.preventDefault();
			if($("#loginText").val()==='')
			{
				alert("Please enter a login!");
				return false;
			}
			console.log('logging');


				var myData2 = 'login_txt='+ $("#login_txt").val();
			console.log(myData2)
			jQuery.ajax({
				type: "POST", // HTTP method POST or GET
				url: "login.php", //Where to make Ajax calls
				dataType:"text", // Data type, HTML, json etc.
				data:myData2, //Form variables
				success:function(response){
					if (response == 'clear') {
							$(".content_wrapper").show();

					}
					//on success, hide  element user wants to delete.
					//$("#loginSubmit").hide(); //hide submit button
				 //	$("#LoadingImage").show(); //show loading image
					},
				error:function (xhr, ajaxOptions, thrownError){
					//On error, we alert user
					alert(thrownError);
				}
			});




	});


	//##### Send delete Ajax request to response.php #########
	$("body").on("click", "#responds .del_button", function(e) {
		 e.preventDefault();
		 var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure

		$('#item_'+DbNumberID).addClass( "sel" ); //change background of this element by adding class
		$(this).hide(); //hide currently clicked delete button

			jQuery.ajax({
				type: "POST", // HTTP method POST or GET
				url: "response.php", //Where to make Ajax calls
				dataType:"text", // Data type, HTML, json etc.
				data:myData, //Form variables
				success:function(response){
					//on success, hide  element user wants to delete.
					$('#item_'+DbNumberID).fadeOut();
				},
				error:function (xhr, ajaxOptions, thrownError){
					//On error, we alert user
					alert(thrownError);
				}
			});
	});

});
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <div class="login_wrapper">  		<!--		add login here -->
    <div class="form_style">
		<input name="login_txt" id="login_txt" ></input>
		<button id="loginSubmit">login</button>
    </div>

</div>
<div class="content_wrapper">
<ul id="responds">
<?php
//include db configuration file
include_once("config.php");

//MySQL query
$results = $mysqli->query("SELECT id,content FROM add_delete_record");
//get all records from add_delete_record table
while($row = $results->fetch_assoc())
{
  echo '<li id="item_'.$row["id"].'">';
  echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$row["id"].'">';
  echo '<img src="images/icon_del.gif" border="0" />';
  echo '</a></div>';
  echo $row["content"].'</li>';
}

//close db connection
$mysqli->close();
?>
</ul>
    <div class="form_style">
    <textarea name="content_txt" id="contentText" cols="45" rows="5" placeholder="Enter some text"></textarea>
    <button id="FormSubmit">Add record</button>
    <img src="images/loading.gif" id="LoadingImage" style="display:none" />
    </div>
</div>

<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>
