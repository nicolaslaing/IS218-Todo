<link rel="stylesheet" href="../view/styles.css">
<?php
//****************************************************************************************
//DATABASE CONNECTION
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);
require '../model/database.php';
require 'functions.php';

//****************************************************************************************
//Find most recent ID number, and add 1 for the newest user
$s = "SELECT * FROM accounts ORDER BY id DESC";
$result = $conn->prepare($s);
$result->execute();
$row = $result->fetch();

$id = $row['id'] + 1;
//END OF RESULT

//User input data retrieval
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$password = $_POST['password'];
//END RETRIEVAL

//Insert user data into "accounts" table in database
$insert = "INSERT INTO accounts VALUES(:id, :email, :fname, :lname, :phone, :birthday, :gender, :password)";
$resultIn = $conn->prepare($insert);
$resultIn->execute(array(
	"id" => $id,
	"email" => $email,
	"fname" => $fname,
	"lname" => $lname,
	"phone" => $phone,
	"birthday" => $birthday,
	"gender" => $gender,
	"password" => $password
));
//END INSERTION

$message = "<fieldset><center>Successfully registered, redirecting in 3 seconds</center></fieldset>";
$target = "../view/login.html";
$delay = 3;

redirect($message, $target, $delay);

?>