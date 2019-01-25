<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Unit 3- PHP Functions</title>
</head>

<?php 

// Question 1
	function todaysDate(){
		date_default_timezone_set("US/Central");
		$date = date('m/d/Y');
		echo $date;
	}
	
// Question 2	
	function internationalDate(){
		$internationalDate = date('d/m/Y');
		echo $internationalDate;
	}
	
// Question 3	
	function stringInput($inString){
		
	
		$lower = strtolower(trim($inString));
		$characterCount = strlen (trim($inString));
		$containsdmacc = stripos($inString, "dmacc");
		
		
		
		echo $lower . " has " , $characterCount . " characters. Does the string contains DMACC?: ";  
		
		if($containsdmacc == true){
			echo "True!";
		}
		
		else {
			echo "False!";
		}
	}
	
// Question 4
	function formattedNumber($number){
		
		echo number_format($number);
		
	}
	
// Question 5
	function currency($number){
		
		// I tried money_format, but it gave me a fatal error
		
		setlocale(LC_MONETARY,"en_US");
		echo "$ ". number_format($number, 2); 
	}
?>
<body>

<h1>Unit 3 - PHP Functions</h1>
<h2>Date in mm/dd/yyyy format</h2>
<p>Today's Date: <?php todaysDate() ?></p>

<h2>Date in dd/mm/yyyy format (International Date)</h2>
<p>International Date: <?php internationalDate() ?></p>

<h2>String Input</h2>
<p>This Word: <?php stringInput(" DMACC Library ")?></p>

<h2>Number Formatting</h2>
<p>Formatted Number: <?php formattedNumber(1234567890) ?></p>

<h2>Currency</h2>
<p>US Currency: <?php currency(123456) ?></p>

</body>

</html>