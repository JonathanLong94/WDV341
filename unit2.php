<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Unit 2- PHP Basics</title>
</head>

<body>

<?php 
	$yourName = "Jonathan"; // Creating a variable and assigning a name to it 
	echo "<h1>PHP Basics</h1>" // Displaying assignment name on the page with h1 element 
?>

<h2><?php echo $yourName ?></h2> 

<?php 

// Assigning variables numbers and displaying the value of each variable 

	$number1 = 2;
	$number2 = 4;
	$total = $number1 + $number2;
	
	echo "The values for number1 and number2 are " .$number1. " and $number2 respectively. The total of the two numbers is $total.";
?>
<br></br>

<script>
	var language = ['PHP' , 'HTML' , 'Javascript'];
	
	<?php echo "document.write(language);" ?>
	
</script>

</body>

</html>