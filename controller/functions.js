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
		url: "../controller/todohandler.php",
		data: {

			id: id,
			message: message

		},

		error: function(xhr, status, error){

			alert("Error: \r\nNumeric code is: " + xhr.status + "\r\nError is: " + error);

		},

		success: function(result) {

			//var result = JSON.parse(result);
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
			//for(var index in result){

				// var id = result[index].id;
				// var owneremail = result[index].owneremail;
				// var ownerid = result[index].ownerid;
				// var createddate = result[index].createddate;
				// var duedate = result[index].duedate;
				// var isdone = result[index].isdone;

				var id = result[0].id;
				var owneremail = result[0].owneremail;
				var ownerid = result[0].ownerid;
				var createddate = result[0].createddate;
				var duedate = result[0].duedate;
				var isdone = result[0].isdone;

				output += "<tr>";
				output += "<td>" + id + "</td>";
				output += "<td>" + owneremail + "</td>";
				output += "<td>" + ownerid + "</td>";
				output += "<td>" + createddate + "</td>";
				output += "<td>" + duedate + "</td>";
				output += "<td>" + isdone + "</td>";
				output += "</tr>";

				$("#incomplete").html($("#incomplete").html() + output);

			//}

			output += "</table>";

			$("#incomplete").html($("#incomplete").html() + output);

		} // success

	}); // ajax

} // insertTodo()