<?php
//ERROR CHECKING
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

//****************************************************************************************
//DATABASE CONNECTION

$user = "nal9";
$password = "Movlksomh123";
$host = "sql1.njit.edu";

$dsn = "mysql:host=$host;dbname=$user";

try {
    $conn = new PDO($dsn, $user, $password);
    echo "<h1><center>Connected to database.</center></h1>";
} catch(PDOException $e) {
    echo "<h1><center>Connection failed: " . $e->getMessage() . "</center></h1>";
}

//****************************************************************************************
?>