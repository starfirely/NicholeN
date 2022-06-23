<?php
// Config
$sendto = 'nnichole49@gmail.com';
$subject = 'New Quote Request';

if ( !empty ($_POST) ){
	// Whitelist
	$name = $_POST['name'];
	$from = $_POST['email'];
	$message = $_POST['message'];
	$honeypot = $_POST['url'];
	
	
	// check honeypot
	if( !empty( $honeypot ) ) {
		echo json_encode(array('status'=>0, 'message'=> 'There was a problem'));
		
		die();
	}
	
	//Check for Empty Values
	if (empty( $name ) || empty( $from ) || empty ( $message ) ){
		echo json_encode(array('status'=>0. 'message'=>'A Required thing you need to do'));
		
		die();
	}
	
	//Check for valid Email 
	$from = filter_var($from, FILTER_VALIDATE_EMAIL);
	
	if( !$from) {
		echo json_encode(array('status'=>0, 'message'=>'Not a Valid Email'));
		
		die();
	}
	
	//send email 
	$headers = sprintf('From: %s', $from) ."\r\n";
	$headers .= sprintf('Reply-to: %s', $from) . "\r\n";
	$headers .= sprintf('X-Mailer: PHP/%s', phpversion());
	
	
	if ( mail($sendto, $subject, $message, $headers) ){
		echo json_encode(array('status'=>1, 'message'=>'Emailsent successfully'));
		
		die();
	}
	
	echo json_encode(array('status'=>0, 'message'=>'Email NOt Sent successfully, please try again'));
} 