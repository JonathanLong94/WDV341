<?php

session_start();

if ($_SESSION['validUser'] !== "yes") {
	header('Location: finalLogin.php');
}

	$contact_email = "";
	$emailErrMsg = "";
	
	if(isset($_POST["submit"]))
	{
		$contact_email = $_POST['contact_email'];
		$contact_contact = $_POST['contact_contact'];
		
		function validateEmail($inEmail)
			{
				global $validForm, $emailErrMsg;			//Use the GLOBAL Version of these variables instead of making them local
				$emailErrMsg = "";							//Clear the error message. 
				
				// Remove all illegal characters from email
				$inEmail = filter_var($inEmail, FILTER_SANITIZE_EMAIL);

				// Validate e-mail
				$inEmail = filter_var($inEmail, FILTER_VALIDATE_EMAIL);

				if($inEmail === false)
				{
					$validForm = false;
					$emailErrMsg = "Invalid email"; 					
				}
				
			}//end validateEmail()
			
			if($contact_contact)	//HoneyPot form verification.  If this field contains content a bot has most likely submitted the form
				{
					header('Location: finalLogin.php');	//sends control back to the login page					
				}
				
			$validForm = true;
			
			validateEmail($contact_email);
			
			if($validForm)
			{
				try {
					
					include("emailer.php");
					
					$testEmail = new emailer();
					$testEmail->setSenderAddress("webformtr18@jonathanlong.info");
					$testEmail->setSendToAddress("long.jonathan9@gmail.com");	
					$testEmail->setMessageBody("Thank you for contacting us. We will reply to you as soon as possible.");	
					$testEmail->setSubjectLine("Contact Us");
					
					echo $testEmail->sendEmail();
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
<title>Contact Page</title>
<style>

#orderArea	{
	width:600px;
	background-color:#4d4dff;
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
<h1>Welcome to the Contact Page</h1>
<h2>Contact Us</h2>

<div id="orderArea">
<form id="form1" name="form1" method="post" action="finalContact.php">

<h3>Contact Form</h3>
	<table width="587" border="0">
		<tr>
			<td width="117">Email:</td>
			<td width="246"><input type="text" name="contact_email" id="contact_email" size="40" value="<?php echo $contact_email;?>"/></td>
			<td width="210" class="error"><?php echo "$emailErrMsg";?></td>
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