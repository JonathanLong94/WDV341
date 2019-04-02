
<?php 
	include 'connect_PDO.php';
	
	$sth = $conn->prepare("SELECT * FROM wdv341_event");
	$sth->execute();
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
			echo "<td><a href='deleteEvent.php?recId=$event_id'>Delete</a>" . "</td>";
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