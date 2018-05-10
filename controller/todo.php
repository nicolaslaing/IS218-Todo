<?php
	require 'functions.php';
	session_start();
	gatekeeper();
?>

<!DOCTYPE html>
<html>

	<head>

		<link rel="stylesheet" href="../view/styles.css">
		<h1>Todo<br>Add Todo</h1><br />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/Javascript">

			$(document).ready(function(){

				$("#add").click(function(){
					var id = "<?php echo $_SESSION['id']; ?>";
					var message = $("#todoInput").val();

					console.log(id);
					console.log(message);
					function insertTodo(){

						$.ajax({

							type: "POST",
							url: "../controller/todohandler.php",
							data: {

								id: id,
								message: message

							},

							error: function(xhr, status, error){

								alert("Error: \r\nNumeric code is: " + xhr.status + "\r\nError is: " + error);

							},

							success: function(result) {

								var result = JSON.parse(result);
								var output;

								output = "<table border='1'>";
								output += "<tr>";
								output += "<td>ID</td>";
								output += "<td>Email</td>";
								output += "<td>Owner ID</td>";
								output += "<td>Created</td>";
								output += "<td>Due</td>";
								output += "<td>Completed</td>";
								output =+ "</tr>";


								//id, owneremail, ownerid, createddate, duedate, message, isdone
								for(var index in result){

									var id = result[0];
									var owneremail = result[1];
									var ownerid = result[2];
									var createddate = result[3];
									var duedate = result[4];
									var isdone = result[5];

									output += "<tr>";
									output += "<td>" + id + "</td>";
									output += "<td>" + owneremail + "</td>";
									output += "<td>" + ownerid + "</td>";
									output += "<td>" + createddate + "</td>";
									output += "<td>" + duedate + "</td>";
									output += "<td>" + isdone + "</td>";
									output += "</tr>";

									$(".todo").html($(".todo").html() + output);

								}

								output += "</table>";

								$(".todo").html($(".todo").html() + output);

							} // success

						}); // ajax

					} // insertTodo()

				}); // click

			}); // ready

		</script>

	</head>

	<body>

		<fieldset><br>

			<input type="text" id="todoInput" placeholder="Enter todo" />
			<input type="submit" id="add" value="Add">

			<div id="out"></div>

		</fieldset><br>

		<center>

			<form action="../controller/logout.php">

				<input type="submit" value="Logout">

			</form>

		</center>

	</body>

</html>