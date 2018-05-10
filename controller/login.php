<html>
	<head>
		<link rel="stylesheet" href="../view/styles.css">
	</head>
	<!-- Show result of authenticating after 1000 milliseconds -->
<!-- 	<script>
		function show(){
			document.getElementById("show").style.display = "block";
		};
		setTimeout(show, 1000);
	</script> -->
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
// GLOBALS
$bad = false;
//****************************************************************************************
// INITIALIZATION
$email = $_POST["email"];
$pass = $_POST["pass"];

if(!auth($email, $pass)){

	$message = "<fieldset><p>Please enter a valid username or password.</p></fieldset>";
	$target = "../view/login.html";
	redirect($message, $target, 3);
}

$_SESSION["logged"] = true;
$_SESSION["email"] = $email;

$message = "<fieldset>" . session_id() . "<br /><br />Logged in. Transferring to Homepage</p></fieldset>";
$target = "../view/todo.html"; // direct to PHP page to deposit/withdraw/show/mail
redirect($message, $target, 3);
?>
