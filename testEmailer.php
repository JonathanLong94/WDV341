<?php	
	include("emailer.php"); // makes your class available to the program 
	
	$testEmail = new emailer();
	
	$testEmail->setSenderAddress("webformtr18@jonathanlong.info");
	
	$testEmail->setSendToAddress("long.jonathan9@gmail.com");
	
	$testEmail->setMessageBody("This is an email testing system.");
	
	$testEmail->setSubjectLine("The Email Testing System");
	
	echo $testEmail->sendEmail(); // test the mail() to send email 
	
	$clientEmail = new emailer();
	
	$clientEmail->setSenderAddress("webformtr18@jonathanlong.info");
	
	$clientEmail->setSendToAddress("long.jonathan9@gmail.com");
	
	$clientEmail->setSubjectLine("The Email Testing System");
	
	$clientEmail->setMessageBody("This is an email testing system. I hope it is sent.");
	
	//echo $clientEmail->sendEmail();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Test Emailer</title>
</head>

<body>
	
	<p>Senders Name: <?php echo $testEmail->getSenderAddress();?></p>
	<p>Recipient's Address: <?php echo $testEmail->getSendToAddress();?></p>	
	<p>Subject: <?php echo $testEmail->getSubjectLine();?></p>
	<p>Message: <?php echo $testEmail->getMessageBody();?></p>
</body>
</html>

