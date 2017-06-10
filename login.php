<?php

  if(isset($_POST["login_txt"]) && strlen($_POST["login_txt"])>0)
   {

      // echo $_POST["login_txt"];
      include_once("config.php");
      if($password == $_POST["login_txt"]) {
        echo 'clear';
      }


  }

?>
