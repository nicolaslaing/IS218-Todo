<?php
	require 'functions.php';
	session_start();
	gatekeeper();
?>

<!DOCTYPE html>
<html>

	<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="functions.js"></script>
		<link rel="stylesheet" href="../view/styles.css">

		<h1>Todo<br>Add Todo</h1><br>

		<input id="session_id" type="hidden" value=<?php echo $_SESSION['id'] ?> />

	</head>

	<body>

		<fieldset><br>

			<p>Welcome, <?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] ?>!</p>

			<input type="text" id="todoInput" placeholder="Enter todo" />
			<input type="submit" id="add" value="Add Task">

			<div id="incomplete"></div>

			<div id="complete"></div>

		</fieldset><br>

		<center>

			<form action="../controller/logout.php">

				<input type="submit" value="Logout">

			</form>

		</center>

	</body>

</html>