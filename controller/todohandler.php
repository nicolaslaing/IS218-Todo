<?php
require '../model/database.php';
$id = $_POST['id'];
$message = $_POST['message'];

// id, email, fname, lname, phone, birthday, gender, password
// Query accounts table to obtain the ID and email of the account
$query = "SELECT * FROM accounts WHERE id=:id";

$sth = $conn->prepare($query);
$sth->bindValue(":id", $id);
$sth->execute();

$r = $sth->fetch();

// Store ID and email
$id = $r[0];
$email = $r[1];

// id, owneremail, ownerid, createddate, duedate, message, isdone
// Query todos tables to get the last ID that was inserted, so the next insertion can be added +1
$getLastId = "SELECT * FROM todos ORDER BY id DESC";

$sth2 = $conn->prepare($getLastId);
$sth2->execute();
$lastId = $sth2->fetch();

$nextId = $lastId[0] + 1;

// Insert the new data into the todos table
$query2 = "INSERT INTO todos (id, owneremail, ownerid, createddate, duedate, message, isdone) VALUES (:nextId, :owneremail, :ownerid, NOW(), NOW(), :message, 0)";
$sth3 = $conn->prepare($query2);

$sth3->bindValue(":nextId", $nextId);
$sth3->bindValue(":owneremail", $email);
$sth3->bindValue(":ownerid", $id);
$sth3->bindValue(":message", $message);
$sth3->execute();


// Query the todos tables to fetch all tasks for that account to be displayed on todo.php
$query3 = "SELECT * FROM todos WHERE ownerid=:id";

$sth4 = $conn->prepare($query3);
$sth4->bindValue(":id", $id);
$sth4->execute();
$result = $sth4->fetchAll();
json_encode($result);

print_r($result);
?>