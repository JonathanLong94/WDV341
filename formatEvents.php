<?php
	//Get the Event data from the server.
	include 'connect_PDO.php';
	
	$sth = $conn->prepare("SELECT * FROM wdv341_events ORDER BY event_presenter DESC");
	$sth->execute(); 
	$numberOfRows = $sth->rowCount();

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
		}
		
		.displayEvent{
			text_align:left;
			font-size:18px;	
			<?php if ($row['event_date'] > date("Y-m-d")){
			?>
				font-style: italic;
			<?php	
				}
			?>
			
			<?php if(date("m", strtotime($row['event_date'])) == date("m")){
				
				?>
				font-style: bold;
				color: red;
			<?php
				}
			?>
		}
		
		.displayDescription {
			margin-left:1px;
		}		
	</style>
</head>

<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   
    <h3> <?php echo $numberOfRows;?> Events are available today.</h3>

<?php
	//Display each row as formatted output in the div below
	while($row = $sth->fetch(PDO::FETCH_ASSOC)){
?>
	<p>
        <div class="eventBlock">	
            <div>
            	<span class="displayEvent">Event: <?php echo $row['event_name']; ?></span>
                <span>Presenter: <?php echo $row['event_presenter']; ?></span>
            </div>
            <div>
            	<span class="displayDescription">Description: <?php echo $row['event_description']; ?></span>
            </div>
            <div>
            	<span class="displayTime">Time: <?php echo $row['event_time']; ?></span>
            </div>
            <div>
            	<span class="displayDate">Date: <?php echo $row['event_date']; ?></span>
            </div>
        </div>
    </p>
	
<?php
	}//Close the database connection	
?>
</div>	
</body>
</html>