<?php

session_start();

if ($_SESSION['validUser'] !== "yes") {
	header('Location: finalLogin.php');
}

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
		
	if( isset($_POST['submit']) ){
		
		$event_name = $_POST['event_name'];
		$event_description = $_POST['event_description'];
		$event_presenter = $_POST['event_presenter'];
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		
		$validForm = true;	
		
		validateEventName();
		validateEventDescription();
		validateEventPresenter();
		validateEventDate();
		validateEventTime();
		
		if($validForm){
			
			try{
				include 'connect_PDO.php';
			
				$sql = "INSERT INTO wdv341_final_event (event_name, event_description, event_presenter, event_date, event_time)
						VALUES(:evtName, :evtDesc, :evtPresent, :evtDate, :evtTime)";
					
				echo "New event created successfully";
			
				$statementObject = $conn->prepare($sql);
			
				$statementObject->bindParam(':evtName', $event_name);
				$statementObject->bindParam(':evtDesc', $event_description);
				$statementObject->bindParam(':evtPresent', $event_presenter);
				$statementObject->bindParam(':evtDate', $event_date);
				$statementObject->bindParam(':evtTime', $event_time);
			
				$statementObject->execute();
			}
			
			catch(PDOException $e){
				
				echo "There has been a problem. The system administrator has been contacted. Please try again later.";
				
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log($e->getLine());
				error_log(var_dump(debug_backtrace()));
			}
		}
		else{
			echo "<h1>The form is not valid</h1>";
		}
	}
	else{
		// Form has not been seen by the user.  display the form
	}// end if submit statement
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Final Project</title>
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
<h1>WDV341 Final Project</h1>
<h2>Event Registration</h2>

<div id="orderArea">
<form id="form1" name="form1" method="post" action="finalEventsForm.php">
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
        <input type="reset" name="button2" id="button2" value="Reset" />
    </p>
</form>
<p><a href="finalLogin.php">Home</a></p>
</div>

</body>
</html>
