<?php
//session_start();
	
	$delete_event_id = $_GET['recId'];
	
		try {
			include 'connect_PDO.php';
		
			$sth = $conn->prepare("DELETE FROM wdv341_event WHERE event_id='$delete_event_id'");
			$sth->execute();
				
			header('Location: selectEvents.php?msg=Event deleted successfully');
		}
		catch(PDOException $e){
			header('Location: selectEvents.php?msg=Event cannot be deleted');
		}
?>