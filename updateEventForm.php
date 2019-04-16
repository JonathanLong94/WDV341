<?php
	$event_name = "";
	$event_description = "";
	$event_presenter = "";
	$event_date = "";
	$event_time = "";
	$event_location = "";
	
	$validForm = false;
	
	$nameErrMsg = "";
	$descErrMsg = "";
	$presErrMsg = "";
	$dateErrMsg = "";
	$timeErrMsg = "";
	$locationErrMsg = "";
	
	$update_event_id = $_GET['recId'];
	
	if( isset($_POST['submit']) ){
		
		$event_name = $_POST['event_name'];
		$event_description = $_POST['event_description'];
		$event_presenter = $_POST['event_presenter'];
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		
		function validateEventName(){
			
			global $event_name, $validForm, $nameErrMsg;
			$nameErrMsg = "";
			
			// Convert quotes to HTML entities
			$event_name = htmlspecialchars($event_name, ENT_QUOTES);
			
			if($event_name == ""){
				$validForm = false;	
				$nameErrMsg = "Event name is required";
			}		
		}
	
		function validateEventDescription(){
			global $event_description, $validForm, $descErrMsg;
			$descErrMsg = "";
			
			// Convert quotes to HTML entities
			$event_description = htmlspecialchars($event_description, ENT_QUOTES);
			
			if($event_description == ""){
				$validForm = false;
				$descErrMsg = "Please provide an event description";
			}
		}
	
		function validateEventPresenter(){
			global $event_presenter, $validForm, $presErrMsg;
			$presErrMsg = "";
			
			// Convert quotes to HTML entities
			$event_presenter = htmlspecialchars($event_presenter, ENT_QUOTES);
			
			if($event_presenter == ""){
				$validForm = false;
				$presErrMsg = "An event presenter is required";
			}
		}
	
		function validateEventDate(){
			global $event_date, $validForm, $dateErrMsg;
			$dateErrMsg = "";
			if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$event_date)){
				$validForm = false;
				$dateErrMsg = "Please use the yyyy-mm-dd format";
			}
		}
	
		function validateEventTime(){
			global $event_time, $validForm, $timeErrMsg;
			$timeErrMsg = "";
			if(!preg_match("^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$^" , $event_time)){
				$validForm = false;
				$timeErrMsg = "Please use the HH:MM:SS format";
			}
		}
		
		$validForm = true;	
		
		validateEventName();
		validateEventDescription();
		validateEventPresenter();
		validateEventDate();
		validateEventTime();
		
		if($validForm){
			
			include 'connect_PDO.php';
		
		// Update the event
			$sql = "UPDATE wdv341_event SET ";			
			$sql .= "event_name='$event_name',";
			$sql .= "event_description='$event_description',";
			$sql .= "event_presenter='$event_presenter',";
			$sql .= "event_date='$event_date',";
			$sql .= "event_time='$event_time' ";
			$sql .= "WHERE event_id='$update_event_id'";
					
			
		
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			/*
				$stmt->bindParam(':evtName', $event_name);
				$stmt->bindParam(':evtDesc', $event_description);
				$stmt->bindParam(':evtPresent', $event_presenter);
				$stmt->bindParam(':evtDate', $event_date);
				$stmt->bindParam(':evtTime', $event_time);
			*/
			echo "New event created successfully";		
		}
		else{
			echo "<h1>The form is not valid</h1>";
		}
	}
	else{
		
		include 'connect_PDO.php';
		
		// Create the SQL SELECT command string
		$sql = "SELECT ";
		$sql .= "event_id, ";
		$sql .= "event_name, ";
		$sql .= "event_description, ";
		$sql .= "event_presenter, ";
		$sql .= "event_date, ";
		$sql .= "event_time ";
		$sql .= "FROM wdv341_event ";
		$sql .= "WHERE event_id='$update_event_id'";
		
		$stmt = $conn->prepare($sql); // prepared statement
		$stmt->execute(); // execute statement
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);	
		$row= $stmt->fetch(PDO::FETCH_ASSOC);
		
			$event_id = $row['event_id'];
			$event_name= $row['event_name'];
			$event_description = $row['event_description'];
			$event_presenter = $row['event_presenter'];
			$event_date = $row['event_date'];
			$event_time = $row['event_time'];
		
		
	} // end if submit statement
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Unit 8</title>
<style>

#orderArea	{
	width:600px;
	background-color:#CF9;
}

.error	{
	color:red;
	font-style:italic;	
}

.honeypot{
	display:none;
}

</style>
</head>

<body>
<h1>Setup a new Event</h1>

	<?php
    //If the form was submitted and valid and properly put into database display the INSERT result message
		if($validForm)
		{
	?>

	<?php
		}
			else	//display form
		{
	?>

	<div id="orderArea">
	<form id="form1" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']). "?recId=$update_event_id"; ?>">
		<h3>Events Form</h3>
		<table width="587" border="0">
			<tr>
				<td width="117">Event Name:</td>
				<td width="246"><input type="text" name="event_name" id="event_name" size="40" value="<?php echo $event_name;?>"/></td>
				<td width="210" class="error"><?php echo "$nameErrMsg";?></td>
			</tr>
			<tr>
				<td width="150">Event Description:</td>
				<td><input type="text" name="event_description" id="event_description" size="40" value="<?php echo $event_description;?>"/></td>
				<td class="error"><?php echo "$descErrMsg";?></td>
			</tr>
			<tr>
				<td>Event Presenter:</td>
				<td><input type="text" name="event_presenter" id="event_presenter" size="40" value="<?php echo $event_presenter;?>"/></td>
				<td class="error"><?php echo "$presErrMsg";?></td>
			</tr>
			<tr>
				<td width="200">Event Date (YYYY-MM-DD):</td>
				<td><input type="text" name="event_date" id="event_date" size="20" value="<?php echo $event_date;?>"/></td>
				<td class="error"><?php echo "$dateErrMsg";?></td>
			</tr>
			<tr>
				<td>Event Time (HH:MM:SS):</td>
				<td><input type="text" name="event_time" id="event_time" size="20" value="<?php echo $event_time;?>"/></td>
				<td class="error"><?php echo "$timeErrMsg";?></td>
			</tr>	
			<tr class="honeypot">
				<td>Event Location:</td>
				<td><input type="text" name="event_location" id="event_location" size="20" value="<?php echo $event_location;?>"/></td>
				<td class="error"><?php echo "$locationErrMsg";?></td>
			</tr>
		</table>
		<p>
			<input type="submit" name="submit" id="button" value="Submit" />
		</p>
	</form>
	<?php
		}//end else
    ?> 
</div>

</body>
</html>