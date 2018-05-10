<html>
	<head>
		<link rel="stylesheet" href="../view/styles.css">
	</head>
	
</html>
<?php
session_start();
require 'functions.php';
$_SESSION = array();
session_destroy();

if(!isset($_SESSION["logged"])){
  $message = "<center><p>You have successfully logged out. Redirecting to login page.</p></center>";
  $target = "../view/login.html";
  $delay = "3";
  redirect($message, $target, $delay);
}
else{
  $message = "<p'>There was an issue with logging out.</p>";
  echo $message;
}
?>