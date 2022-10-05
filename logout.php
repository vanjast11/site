<?php 
	require 'head.php';
  if($_SERVER["REQUEST_METHOD"] === "POST")
  {
    $result = new USER();
    $result->UserLogout($_SESSION[User][User_Id]);
    $_SESSION = array();
    header("Location: index.php");
  }
  else
  {
	header("Location: index.php");
  }


?>