<?php
	session_start();

	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/accessTest.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/stTestFunctions.inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
	include 'logout.inc.php';
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/editAccount.inc.php';

	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/uploadData.inc.php';
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/viewData.inc.php';
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/login.inc.php';
	
	
	include 'login.html.php';
?>
