


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
      var callbackObj = {
        success: function (response) {
          $("#responds").append(response);
  				$("#contentText").val(''); //empty text field on successful
  				$("#FormSubmit").show(); //show submit button
  				$("#LoadingImage").hide(); //hide loading image
        },
        error: function (xhr, ajaxOptions, thrownError){
          $("#FormSubmit").show(); //show submit button
  				$("#LoadingImage").hide(); //hide loading image
  				alert(thrownError);
        }
      }
      jqueryAjax('response.php', myData, callbackObj)

      // jQuery.ajax({
			// type: "POST", // HTTP method POST or GET
			// url: "response.php", //Where to make Ajax calls
			// dataType:"text", // Data type, HTML, json etc.
			// data:myData, //Form variables
			// success:function(response){
      //
      //
			// },
			// error:function (xhr, ajaxOptions, thrownError){
			// 	$("#FormSubmit").show(); //show submit button
			// 	$("#LoadingImage").hide(); //hide loading image
			// 	alert(thrownError);
			// }
			// });
	});


// ############# login here  ################
	$("#loginSubmit").click(function (e) {
			e.preventDefault();
			if($("#loginText").val()==='')
			{
				alert("Please enter a login!");
				return false;
			}

			var myData = 'login_txt='+ $("#loginTxt").val();
      var callbackObj = {
        success: function (response) {
          if (response == 'clear') {
							$(".content_wrapper").show();

					}
        },
        error: function (xhr, ajaxOptions, thrownError){
          //On error, we alert user
          alert(thrownError);
        }
      }
      jqueryAjax('login.php', myData, callbackObj)

      // jQuery.ajax({
			// 	type: "POST", // HTTP method POST or GET
			// 	url: "login.php", //Where to make Ajax calls
			// 	dataType:"text", // Data type, HTML, json etc.
			// 	data:myData, //Form variables
			// 	success:function(response){
			// 		if (response == 'clear') {
			// 				$(".content_wrapper").show();
      //
			// 		}
			// 		//on success, hide  element user wants to delete.
			// 		//$("#loginSubmit").hide(); //hide submit button
			// 	 //	$("#LoadingImage").show(); //show loading image
			// 		},
			// 	error:function (xhr, ajaxOptions, thrownError){
			// 		//On error, we alert user
			// 		alert(thrownError);
			// 	}
			// });
	});

	//##### Send delete Ajax request to response.php #########
	$("body").on("click", "#responds .del_button", function(e) {
		 e.preventDefault();
		 var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure

		$('#item_'+DbNumberID).addClass( "sel" ); //change background of this element by adding class
		$(this).hide(); //hide currently clicked delete button

    var callbackObj = {
      success: function (response) {
          $('#item_'+DbNumberID).fadeOut();
      },
      error: function (xhr, ajaxOptions, thrownError){
        //On error, we alert user
        alert(thrownError);
      }
    }
    jqueryAjax('response.php', myData, callbackObj)
			// jQuery.ajax({
			// 	type: "POST", // HTTP method POST or GET
			// 	url: "response.php", //Where to make Ajax calls
			// 	dataType:"text", // Data type, HTML, json etc.
			// 	data:myData, //Form variables
			// 	success:function(response){
			// 		//on success, hide  element user wants to delete.
			// 		$('#item_'+DbNumberID).fadeOut();
			// 	},
			// 	error:function (xhr, ajaxOptions, thrownError){
			// 		//On error, we alert user
			// 		alert(thrownError);
			// 	}
			// });
	});

function jqueryAjax(file, myData, callback) {
    jQuery.ajax({
      type: "POST", // HTTP method POST or GET
      url: file, //Where to make Ajax calls
      dataType:"text", // Data type, HTML, json etc.
      data:myData, //Form variables
      success: callback.success,
      error: callback.error
    });
}

});
