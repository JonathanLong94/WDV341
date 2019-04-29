<?php

session_cache_limiter('none');	//This prevents a Chrome error when using the back button to return to this page.
session_start();

$message = "";

	if (isset($_SESSION['validUser']) && $_SESSION['validUser'] == "yes")				//is this already a valid user?
		{
			//User is already signed on.  Skip the rest.
			$message = "Welcome Back! $inUsername";	//Create greeting for VIEW area		
		}
		
	else {
		if (isset($_POST['submitLogin']) ) 
		{
			try{
				$inUsername = $_POST['loginUsername'];	//pulls the username from the form
				$inPassword = $_POST['loginPassword'];	//pulls the password from the form
			
				include 'connect_PDO.php';	
			
				$sql = "SELECT event_user_name,event_user_password FROM event_user 
				WHERE event_user_name = :username AND event_user_password = :userpassword";
			
				$query = $conn->prepare($sql) or die("<p>SQL String: $sql</p>");
			
				$query->bindParam(":username",$inUsername);
				$query->bindParam(":userpassword", $inPassword);
			
				$query->execute();
			}
			catch(PDOException $e){
				
				echo "There has been a problem. The system administrator has been contacted. Please try again later.";
				
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log($e->getLine());
				error_log(var_dump(debug_backtrace()));
			}
			
			$row = $query->fetch(PDO::FETCH_ASSOC);
			
			if ($row != "" )
			{
				$_SESSION['validUser'] = "yes";
				$_SESSION['userName'] = $row['event_user_name'];
				$message = "Welcome Back! $inUsername";
			}
			
			else{
				$_SESSION['validUser'] = "no";
				$message = "Sorry, there was a problem with your username or password. Please try again.";
			}
			
			$query = null;
			$conn = null;
			
		}
		//end if submitted
		else
		{
			//user needs to see form
		}//end else submitted
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Events Page</title>

</head>

<body>

<h1>WDV341 Intro PHP</h1>

<h2>Events Admin System</h2>

<h2><?php echo $message?></h2>

<?php
	if (isset($_SESSION['validUser']) && $_SESSION['validUser'] == "yes")	//This is a valid user. Show the Administrator Page
	{
		
//turn off PHP and turn on HTML
?>
		<h3>Administrator Options</h3>
        <p><a href="finalEventsForm.php">Input New Events</a></p>
        <p><a href="finalSelectEvent.php">List of Events</a></p>
		<p><a href="finalContact.php">Contact Us</a></p>
        <p><a href="finalLogout.php">Logout of Administrator</a></p>

<?php
	}
	else			//The user needs to log in.  Display the Login Form
	{
?>

			<h2>Please login to the Administrator System</h2>
                <form method="post" name="loginForm" action="finalLogin.php" >
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
				  
                </form>
				
<?php //turn off HTML and turn on PHP
	}//end of checking for a valid user
			
//turn off PHP and begin HTML			
?>	

<p>Back to <a href='#'>www.eventsregistration.com</a></p>			
</body>
</html>


