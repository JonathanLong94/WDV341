<?php

class emailer {
	
	private $senderAddress;
	private $sendToAddress;
	private $subjectLine;
	private $messageBody;
	
	public function __construct (){
		// empty constructor with no functionality 
	}
	
	// setters and getters
	
	public function setMessageBody($inMessage){
		$this->messageBody = $inMessage;
	}
	
	public function getMessageBody(){
		return $this->messageBody;	
	}
	
	public function setSenderAddress($inSender){
		$this->senderAddress = $inSender;
	}
	
	public function getSenderAddress(){
		return $this->senderAddress;
	}
	
	public function setSubjectLine($inSubject){
		$this->subjectLine = $inSubject;
	}
	
	public function getSubjectLine(){
		return $this->subjectLine;
	}
	
	public function setSendToAddress($inSendToAddress){
		$this->sendToAddress = $inSendToAddress;
	}
	
	public function getSendToAddress(){
		return $this->sendToAddress;
	}
	
	public function sendEmail(){
		
		$to = $this->getSendToAddress();
		$subject = $this->getSubjectLine();
		$message = $this->getMessageBody();
		$headers = "From: " . $this->getSenderAddress() . "\r\n";
		
		if(mail($to,$subject,$message, $headers)){
			echo "Message Successfully Sent!";
		}
		else{
			echo "Message Failed to Sent";
		}
	}
}

?>