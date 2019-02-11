<?php
	$cust_name = "";
	$cust_number = "";
	$cust_email = "";
	$cust_registration = "";
	$badge = "";
	$meal = "";
	$request = "";
	$cust_gender = ""; //honeypot
	
	$name_errmsg = "";
	$number_errmsg = "";
	$email_errmsg = "";
	$request_errmsg = "";
	
	if(isset($_POST['cust_submit'])){
		
		echo "<h1>Your form has been submitted!</h1>";
		
		$cust_name = $_POST["cust_name"];
		$cust_number = $_POST["cust_number"];
		$cust_email = $_POST["cust_email"];
		$cust_registration = $_POST["cust_registration"];
		$badge = $_POST["badge"];
		$meal = $_POST["meal"];
		$request = $_POST["request"];
		
		if(empty($cust_name)){
			$name_errmsg = "Please enter a customer name";
		}
		
		if(empty($cust_number)){
			$number_errmsg = "Please enter a phone number";
		}
		
		if(empty($cust_email)){
			$email_errmsg = "Please enter your email";
		}
		
		if(empty($request)){
			$request_errmsg = "Type 'No request' if you don't have any";
		}
	}
?>

<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Self Posting Form</title>
<style>

#orderArea	{
	width:600px;
	border:thin solid black;
	margin: auto auto;
	padding-left: 20px;
}

#orderArea h3	{
	text-align:center;	
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
<h1>WDV341 Intro PHP</h1>
<h2>Unit-5 and Unit-6 Self Posting - Form Validation Assignment


</h2>
<p>&nbsp;</p>


<div id="orderArea">
<form name="form3" method="post" action="">
  <h3>Customer Registration Form</h3>

      <p>
        <label for="cust_name">Name:</label>
        <input type="text" name="cust_name" id="cust_name" value="<?php echo $cust_name ?>">
		<span class="error" id="errorName"><?php echo $name_errmsg; ?></span>
      </p>
      <p>
        <label for="cust_number">Phone Number:</label>
        <input type="text" name="cust_number" id="cust_number" value="<?php echo $cust_number ?>">
		<span class="error" id="errorNumber"><?php echo $number_errmsg; ?></span>
      </p>
      <p>
        <label for="cust_email">Email Address: </label>
        <input type="text" name="cust_email" id="cust_email" value="<?php echo $cust_email ?>">
		<span class="error" id="errorEmail"><?php echo $email_errmsg; ?></span>
      </p>
      <p>
        <label for="cust_registration">Registration: </label>
        <select name="cust_registration" id="cust_registration">
          <option value="">Choose Type</option>
          <option value="attendee" <?php if (isset($cust_registration) && $cust_registration =="attendee") echo "selected"?>>Attendee</option>
          <option value="presenter"<?php if (isset($cust_registration) && $cust_registration =="presenter") echo "selected"?>>Presenter</option>
          <option value="volunteer" <?php if (isset($cust_registration) && $cust_registration =="volunteer") echo "selected"?>>Volunteer</option>
          <option value="guest" <?php if (isset($cust_registration) && $cust_registration =="guest") echo "selected"?>>Guest</option>
        </select>
      </p>
      <p>Badge Holder:</p>
      <p>
        <input type="radio" name="badge" <?php if (isset($badge) && $badge=="clip") echo "checked"?> id="clip" value="clip">
        <label for="clip">Clip</label> <br>
        <input type="radio" name="badge" <?php if (isset($badge) && $badge=="lanyard") echo "checked"?> id="lanyard" value="lanyard">
        <label for="lanyard">Lanyard</label> <br>
        <input type="radio" name="badge" <?php if (isset($badge) && $badge=="magnet") echo "checked"?> id="magnet" value="magnet">
        <label for="magnet">Magnet</label>
      </p>
      <p>Provided Meals (Select all that apply):</p>
      <p>
        <input type="checkbox" name="meal" <?php if (isset($meal) && $meal=="friday") echo "checked" ?> id="friday" value="friday">
        <label for="friday">Friday Dinner</label><br>
        <input type="checkbox" name="meal" <?php if (isset($meal) && $meal=="saturday") echo "checked" ?> id="saturday" value="saturday">
        <label for="saturday">Saturday Lunch</label><br>
        <input type="checkbox" name="meal" <?php if (isset($meal) && $meal=="sunday") echo "checked" ?>id="sunday" value="sunday">
        <label for="sunday">Sunday Award Brunch</label>
      </p>
      <p>
        <label for="request">Special Requests/Requirements: (Limit 200 characters)<br>
        </label>
        <textarea cols="40" rows="5" name="request"><?php echo $request; ?></textarea>
		<span class="error" id="errorRequest"><?php echo $request_errmsg; ?></span>
      </p>
   
	  <p class="honeypot">
        <label for="cust_gender">Gender:</label>
        <input type="text" name="cust_gender" id="cust_gender" value="<?php echo $cust_gender ?>">
      </p>
  <p>
    <input type="submit" name="cust_submit" id="cust_submit" value="Submit">
    <input type="reset" name="Reset" id="button4" value="Reset">
  </p>
</form>
</div>

</body>
</html>