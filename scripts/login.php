<?php

  session_start();
  if(isset($_POST['uName']) &&$_POST['uName']==="oleksik")
  {
    $_SESSION['message']="Authenticated";
    header("Location:../index.php");

  }
   
    else
   {
     header("Location:../index.php? error wrong details");
   }
?>