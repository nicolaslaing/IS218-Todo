<?php

require '../model/database.php';

function auth($email, $password){
	global $conn;
	
	$query = "SELECT * FROM accounts WHERE email=:email AND password=:password";

	$r = $conn->prepare($query);
	$r->bindValue(":email", $email);
	$r->bindValue(":password", $password);
	$r->execute();

	$numRows = $r->fetchColumn();
	print "<h1>Authenticating...</h1><br>";
	if($numRows != 0){
		return true;
	}
	else{
		return false;
	}
}
function getData($email){

	global $conn;
	
	$query = "SELECT * FROM accounts WHERE email=:email";

	$r = $conn->prepare($query);
	$r->bindValue(":email", $email);
	$r->execute();

	$result = $r->fetch();

	return $result;

}
function gatekeeper(){
	// check if $_SESSION["logged"] = true
	if(!isset($_SESSION["logged"])){
		$message = "<p class='stnrd'>Undefined Login.</p>";
		$target = "login.html";
		$delay = 3;
		redirect($message, $target, $delay);
	}
}
function redirect($message, $target, $delay){

	echo $message;
	header("refresh: $delay, url = $target");

	exit();

}
?>