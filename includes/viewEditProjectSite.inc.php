<?php
	if(isset($_POST['action']) && $_POST['action'] == 'View And Edit Projects And Sites'){
		
		$projects = getAllProjects();
		$sites = getAllSites();
		
		include 'view.html.php';
		exit();
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'Edit Project Details'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		include 'editProject.html.php';
		exit();
	}
	
	if(isset($_GET['editProject'])){
	
		editProject();
	
		header('Location: .');
		exit();
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'Edit Site Details'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$lat = $_POST['lat'];
		$lon = $_POST['lon'];
		include 'editSite.html.php';
		exit();
	}
	
	if(isset($_GET['editSite'])){
	
		editSite();

		header('Location: .');
		exit();
	}
?>