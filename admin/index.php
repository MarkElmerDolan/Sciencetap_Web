<?php
	session_start();
	include 'logout.inc.php';

	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/loggedIn.inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	
	include 'display.html.php';
?>