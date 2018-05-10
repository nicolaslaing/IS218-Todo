$(document).ready(function(){

	$("#add").click(function(){
	
		insertTodo();

	}); // click

}); // ready

function insertTodo(){

	var id = $("#session_id").val();
	var message = $("#todoInput").val();

	console.log(id);
	console.log(message);
	$.ajax({

		type: "POST",
		url: "todohandler.php",
		dataType: "text",
		contentType: "application/json",
		data: {

			id: id,
			message: message

		},

		error: function(xhr, status, error){

			alert("Error: \r\nNumeric code is: " + xhr.status + "\r\nError is: " + error);

		},

		success: function(result) {

			var result = JSON.parse(result);
			console.log(result);
			var id;
			var owneremail;
			var ownerid;
			var createddate;
			var duedate;
			var isdone;

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
			// for(var index in result){

				// id = result[index].id;
				// owneremail = result[index].owneremail;
				// ownerid = result[index].ownerid;
				// createddate = result[index].createddate;
				// duedate = result[index].duedate;
				// isdone = result[index].isdone;

				id = result[0].TodoID;
				owneremail = result[0].owneremail;
				ownerid = result[0].ownerid;
				createddate = result[0].createddate;
				duedate = result[0].duedate;
				isdone = result[0].isdone;

				output += "<tr>";
				output += "<td>" + id + "</td>";
				output += "<td>" + owneremail + "</td>";
				output += "<td>" + ownerid + "</td>";
				output += "<td>" + createddate + "</td>";
				output += "<td>" + duedate + "</td>";
				output += "<td>" + isdone + "</td>";
				output += "</tr>";

				$("#incomplete").html($("#incomplete").html() + output);

			// }

			output += "</table>";

			$("#incomplete").html($("#incomplete").html() + output);

		} // success

	}); // ajax

} // insertTodo
function deleteTodo(){

	var id = $("#session_id").val();
	var todoID = $("").val();

	console.log(id);
	$.ajax({

		type: "POST",
		url: "../controller/todohandler.php",
		data: {

			id: id,

		},

		error: function(xhr, status, error){

			alert("Error: \r\nNumeric code is: " + xhr.status + "\r\nError is: " + error);

		},

		success: function(result) {

			$("#delete").html("");
			$("#delete").html("Task deleted");

		} // success

	}); // ajax

} // deleteTodo()