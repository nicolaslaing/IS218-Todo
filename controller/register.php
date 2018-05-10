<link rel="stylesheet" href="styles.css">
<?php
//****************************************************************************************
//DATABASE CONNECTION
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

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
//$conn = null;

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

//Select most recent row for proof that the data was inserted into the table
$s = "SELECT * FROM accounts WHERE id=$id";
$result = $conn->prepare($s);
$result->execute();

$row = $result->fetch();
	$out = "<fieldset><center><legend>You have successfully registered!<br /><br /></legend></center>";
	$out .= "<center><div>";
	$out .= "First name: " . $row['fname'] . "<br />";
	$out .= "Last name: " . $row['lname'] . "<br />";
	$out .= "Email: " . $row['email'] . "<br />";
	$out .= "Phone: " . $row['phone'] . "<br />";
	$out .= "Birthday: " . $row['birthday'] . "<br />";
	$out .= "Gender: " . $row['gender'] . "<br /></div></center></fieldset>";
echo $out;

$result->closeCursor();
//END DATABASE PROOF
?>