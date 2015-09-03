<?php
	session_start();
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/stTestFunctions.inc.php';
	include 'logout.inc.php';
	
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] == FALSE){
			header('Location: ../..');
			exit();
		}
	}else{
		header('Location: ../..');
		exit();
	}
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/createUser.inc.php';

	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/manageUsers.inc.php';
	
	$users = getAllUsers();

	include 'display.html.php';
?>