<?php
	session_start();
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
	include 'logout.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/stTestFunctions.inc.php';

	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] == FALSE){
			header('Location: ../..');
			exit();
		}
	}else{
		header('Location: ../..');
		exit();
	}
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/createForm.inc.php';
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/viewAssignForms.inc.php';
	
	include 'display.html.php';
?>