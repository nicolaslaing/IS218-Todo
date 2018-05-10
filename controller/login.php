<html>

	<head>

		<link rel="stylesheet" href="../view/styles.css">

	</head>

</html>	
<?php
//****************************************************************************************
// SESSION START - ERROR REPORT - FUNCTION INCLUSION
session_set_cookie_params(0, "/~nal9/IS218/todo/", "web.njit.edu");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);


require '../model/database.php';
require 'functions.php';

//****************************************************************************************
// INITIALIZATION
$email = $_POST["email"];
$pass = $_POST["pass"];

if(!auth($email, $pass)){

	$message = "<fieldset><p>Please enter a valid username or password.</p></fieldset>";
	$target = "../view/login.html";
	redirect($message, $target, 3);

}

$data = getData($email);
//json_encode($data);

$_SESSION["logged"] = true;
$_SESSION["id"] = $data[0];
$_SESSION["email"] = $email;

$message = "<fieldset>" . "Session ID: " . session_id() . "<br><br>Logged in. Transferring to Homepage</p></fieldset>";
$target = "../controller/todo.php"; // direct to PHP page to deposit/withdraw/show/mail
redirect($message, $target, 3);
?>
