<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	
	try{
		$sql = 'SELECT id, project_name FROM project';
		$s = $pdo->prepare($sql);
		$s->execute();
	}catch(PDOException $e){
		$error = 'Error fetching project';// . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
	foreach($s as $row){
		$projects[] = array('name' => $row['project_name'], 'id' => $row['id']);
	}
	
	include 'display.html.php';
	exit();
	
?>