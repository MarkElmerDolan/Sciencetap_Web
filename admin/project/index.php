<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/stTestFunctions.inc.php';
	include 'logout.inc.php';
	
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/createProject.inc.php';
	
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/createSite.inc.php';

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/viewEditProjectSite.inc.php';
	
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/assignSite.inc.php';
	
	$projects = getAllProjects();
	
	include 'display.html.php';
?>