<?php
	$text = 'PHP rules!';
	$email = 'mark@temple.edu';
	
	if(preg_match('/^PH.*/', $text)){
	// lowercase if(preg_match('/PHP/i', $text)){
	// exact if(preg_match('/PHP/', $text)){
		$error = '$text contains the string &ldquo;PHP&rdquo;.';
	}else{
		$error = '$text does not contain the string &ldquo;PHP&rdquo;.';
	}
	
	if(preg_match('/^[\w\.\-]+@([\w\-]+\.)+[a-z]+$/i', $email)){
		$error .= '$email contains a valid email.';
	}else{
		$error .= '$email does not contain a valid email.';
	}
	
	include 'error.html.php';
?>