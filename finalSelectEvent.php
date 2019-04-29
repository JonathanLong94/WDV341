<?php 
session_start();

if ($_SESSION['validUser'] !== "yes") {
	header('Location: finalLogin.php');
}

	try {
		include 'connect_PDO.php';
	
		$sth = $conn->prepare("SELECT * FROM wdv341_final_event");
		$sth->execute();
	
	}

	catch (PDOException $e){
	
		echo "There has been a problem. The system administrator has been contacted. Please try again later.";
				
		error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
		error_log($e->getLine());
		error_log(var_dump(debug_backtrace()));
				
	}
?>

<table border='1'>
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Description</td>
		<td>Presenter</td>
		<td>Date</td>
		<td>Time</td>
		<td>Delete</td>
		<td>Update</td>

<?php
	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$event_id = $row['event_id'];
		echo "<tr>";
			echo "<td>" . $row['event_id'] . "</td>";
			echo "<td>" . $row['event_name'] . "</td>";	
			echo "<td>" . $row['event_description'] . "</td>";
			echo "<td>" . $row['event_presenter'] . "</td>";
			echo "<td>" . $row['event_date'] . "</td>";
			echo "<td>" . $row['event_time'] . "</td>";
			echo "<td><a href='finalDeleteEvent.php?recId=$event_id'>Delete</a>" . "</td>";
			echo "<td><a href='finalUpdateEvent.php?recId=$event_id'>Update</a>" . "</td>";
		echo "</tr>";
	}
?>
</table>

<?php 
	echo "<br>";
	if(isset($_GET['msg'])){
		echo $_GET['msg'];
	}
?>

<!DOCTYPE html>
<html>
<head>
</head>

<body>
	<p><a href="finalLogin.php">Home</a></p>
</body>
</html>		