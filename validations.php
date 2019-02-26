<?php
	
	class validations {
		
		public function __construct(){
			//empty constructor with no functionality
		}
		
		public function validateName($cust_name){
			$name_ErrMsg = "";
			
			if(empty($cust_name)){
				echo "Please enter a valid name";
			}
			
			if(preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $cust_name)){
				echo "Do not enter special characters";
			}
		}
		
		public function validatePhoneNumber($inNumber){
			
			if((!preg_match('/^\d{10}$/', $inNumber))){
				echo ("Invalid phone number");
			}
			
		}
		
		public function validateEmail($inEmail){
			
			/*if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$inEmail)){
				echo ("Invalid email format");
			}*/
			
			if(!filter_var($inEmail, FILTER_VALIDATE_EMAIL)){
				echo("Invalid email format");
			}
		}
		
		public function validateRequest($inRequest){
			
			if(preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $inRequest)){
				echo ("Do not enter special characters");
			}
		}
				
}

	/*if(isset($_POST['cust_submit'])){
		
		echo "<h1>Your form has been submitted!</h1>";
		
		$cust_name = $_POST["cust_name"];
		$cust_number = $_POST["cust_number"];
		$cust_email = $_POST["cust_email"];
		$cust_registration = $_POST["cust_registration"];
		$badge = $_POST["badge"];
		$meal = $_POST["meal"];
		$request = $_POST["request"];
		
		$validForm = true;
		
		validateName();
		validatePhoneNumber();
		validateEmail();
		validateRegistration();
		validateBadge();
		validateRequest();*/
?>