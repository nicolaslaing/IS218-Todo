<?php
require '../model/database.php';
$id = $_POST['id'];
$message = $_POST['message'];

$query = "SELECT * FROM accounts WHERE id=':id'";

$r = $conn->prepare($query);
$r->bindValue(":id", $id);
$r->execute();

$result = $r->fetch();
//id, email, fname, lname, phone, birthday, gender, password
//id, owneremail, ownerid, createddate, duedate, message, isdone
$id = $result[0];
$email = $result[1];

$query2 = "INSERT INTO todos (id, owneremail, ownerid, createddate, duedate, message, isdone) VALUES (1, :owneremail, :ownerid, NOW(), NOW(), :message, 'false')";
$r2 = $conn->prepare($query2);

$r2->bindValue(":owneremail", $email);
$r2->bindValue(":id", $id);
$r2->bindValue(":message", $message);
$r2->execute();

$query = "SELECT * FROM todos WHERE id=':id'";

$r = $conn->prepare($query);
$r->bindValue(":id", $id);
$r->execute();
$result = $r->fetch();

echo $result;
?>