<?php

class SmsComponent extends Component {
	
	var $apiUrl = 'http://api.txtlocal.com/send';
	var $username = 'sidmalde@gmail.com';
	var $password = 'El3phant';
	var $apiKey = 'UPSrKoLWEVI-Z3mOqUaac3KUeUPuJWPnPGfKIbtzPW';
	var $from = 'Adya Ayurveda';
	
	function send($number = '44545976559', $message = 'This is a test message', $test = false){
		$message = urlencode($message);
		
		// Prepare data for POST request
		$data = array(
			"apiKey" => $this->apiKey,
			"sender" => $this->from,
			"message" => $message,
			"numbers" => $number,
			"test" => $test,
		);
		
		// Send the POST request with cURL
		$ch = curl_init($this->apiUrl);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		debug(json_decode($response)); die;
		if(!empty($response)){ //This is the result from Txtlocal
			CakeLog::write('sms', sprintf(date("Y-m-d h:i:s") . ' SMS: %s successfully sent a message to %s with the contents: %s, request from: %s, email: %s', $this->from, $number, $message, $_SERVER['REMOTE_ADDR'], $email));
			return true;
		} else {
			CakeLog::write('sms', sprintf(date("Y-m-d h:i:s") . ' SMS: %s failed to send a message to %s with the contents: %s, request from: %s, email: %s', $this->from, $number, $message, $_SERVER['REMOTE_ADDR'], $email));
			return false;		
		}
	}
}
