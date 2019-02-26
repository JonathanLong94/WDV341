<?php

	include("validations.php");
	$formValidations = new validations();
	
	$cust_name = "";
	$cust_number = "";
	$cust_email = "";
	$cust_registration = "";
	$badge = "";
	$meal = "";
	$request = "";
	$cust_gender = ""; //honeypot
	
	$name_ErrMsg = "";
	$number_ErrMsg = "";
	$email_ErrMsg = "";
	$request_ErrMsg = "";
	
	if(isset($_POST['cust_submit'])){
		
		$cust_name = $_POST["cust_name"];
		$cust_number = $_POST["cust_number"];
		$cust_email = $_POST["cust_email"];
		
		$cust_registration = $_POST["cust_registration"];
		$badge = $_POST["badge"];
		$meal = $_POST["meal"];
		$request = $_POST["request"];
		

	}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customer Validation</title>
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
<h2>Unit 6- Form Validation</h2>

<div id="orderArea">
<form name="form3" method="post" action="">
  <h3>Customer Registration Form</h3>

      <p>
        <label for="cust_name">Name:</label>
        <input type="text" name="cust_name" id="cust_name" value="<?php echo $cust_name ?>">
		<span class="error" id="errorName"><?php echo $formValidations -> validateName($cust_name)?></span>
      </p>
	  <p>
        <label for="cust_number">Phone Number (Maximum 10 characters):</label>
        <input type="text" maxlength = "10" name="cust_number" id="cust_number" value="<?php echo $cust_number ?>">
		<span class="error" id="errorNumber"><?php echo $formValidations -> validatePhoneNumber($cust_number)?></span>
      </p>
	  <p>
        <label for="cust_email">Email Address: </label>
        <input type="text" name="cust_email" size = "35" id="cust_email" value="<?php echo $cust_email ?>">
		<span class="error" id="errorEmail"><?php echo $formValidations -> validateEmail($cust_email)?></span>
      </p>
	  <p>
        <label for="cust_registration">Registration: </label>
        <select name="cust_registration" required id="cust_registration">
          <option value="">Choose Type</option>
          <option value="attendee" <?php if (isset($cust_registration) && $cust_registration =="attendee") echo "selected"?>>Attendee</option>
          <option value="presenter"<?php if (isset($cust_registration) && $cust_registration =="presenter") echo "selected"?>>Presenter</option>
          <option value="volunteer" <?php if (isset($cust_registration) && $cust_registration =="volunteer") echo "selected"?>>Volunteer</option>
          <option value="guest" <?php if (isset($cust_registration) && $cust_registration =="guest") echo "selected"?>>Guest</option>
        </select>
      </p>
	  <p>Badge Holder:</p>
      <p>
        <input type="radio" name="badge" <?php if (isset($badge) && $badge=="clip") echo "checked"?> id="clip" value="clip" required>
        <label for="clip">Clip</label> <br>
        <input type="radio" name="badge" <?php if (isset($badge) && $badge=="lanyard") echo "checked"?> id="lanyard" value="lanyard">
        <label for="lanyard">Lanyard</label> <br>
        <input type="radio" name="badge" <?php if (isset($badge) && $badge=="magnet") echo "checked"?> id="magnet" value="magnet">
        <label for="magnet">Magnet</label>
      </p>
	  <p>Provided Meals (Select all that apply/Optional):</p>
      <p>
		<input type ="hidden" name="meal" value="not checked">
        <input type="checkbox" name="meal" <?php if (isset($meal) && $meal=="friday") echo "checked" ?> id="friday" value="friday">
        <label for="friday">Friday Dinner</label><br>
        <input type="checkbox" name="meal" <?php if (isset($meal) && $meal=="saturday") echo "checked"?> id="saturday" value="saturday">
        <label for="saturday">Saturday Lunch</label><br>
        <input type="checkbox" name="meal" <?php if (isset($meal) && $meal=="sunday") echo "checked"?>id="sunday" value="sunday">
        <label for="sunday">Sunday Award Brunch</label>
      </p>
	  <p>
        <label for="request">Special Requests/Requirements: (Limit 200 characters)<br>
        </label>
        <textarea cols="40" rows="5" maxlength="200" name="request"><?php echo $request; ?></textarea>
		<span class="error" id="errorRequest"><?php echo $formValidations -> validateRequest($request)?></span>
      </p>
	  <p class="honeypot">
        <label for="cust_gender">Gender:</label>
        <input type="text" name="cust_gender" id="cust_gender" value="<?php echo $cust_gender ?>">
      </p>
	  <p>
		<input type="submit" name="cust_submit" id="cust_submit" value="Submit">
	  </p>
</form>
</div>	  
</body>
</html>