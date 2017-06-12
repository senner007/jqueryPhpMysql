<?php
// echo PHP_VERSION;
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Ajax Add/Delete a Record with jQuery Fade In/Fade Out</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
 <div class="login_wrapper">  		<!-- login -->
    <div class="form_style">
		<input id="loginTxt" ></input>
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
<script type="text/javascript" src="main.js"></script>
</body>
</html>
