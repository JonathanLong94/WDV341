<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Output</title>

<script>
	var names = <?php echo "['Jeff','Mary','Mark']"; ?>; 
	
	<?php 
		$firstname = "Jeff";
		$secondname = "Mary";
		$thirdname = "Mark";
	?>
	
	var names2 = <?php echo "['$firstname', '$secondname', '$thirdname']"; ?>;
	
	var names3 = <?php echo "['" .$firstname."', '" .$secondname."', '" .$thirdname."']"; ?>;
</script>
</head>
<body>
	
</body>
</html>