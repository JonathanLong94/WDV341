<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Display</title>
<style>
	.redDiv {
		background-color: red;
		width: 200px;
		height: 200px;
		margin: auto auto;
	}
	
	.greenDiv {
		background-color: green;
		width: 200px;
		height: 200px;
		margin: auto auto;
	}
	
	.blueDiv {
		background-color: blue;
		width: 200px;
		height: 200px;
		margin: auto auto;
	}
</style>
</head>
<body>

	<?php $colorCode = 5; ?>

	<?php 
		if($colorCode == 1 || $colorCode == 2|| $colorCode == 3){
		?>
				<div class = "redDiv">
					<h1>Red Div</h1>
				</div>
		<?php
		} 
		elseif ($colorCode == 4 || $colorCode == 5 || $colorCode == 6){
		?>
				<div class = "greenDiv">
					<h1>Green Div</h1>
				</div>
		<?php
		}
		elseif ($colorCode >= 7){
		?>
				<div class = "blueDiv">
					<h1>Blue Div</h1>
				</div>
		<?php		
		}
		?>
</body>
</html>