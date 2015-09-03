<?php
	if(isset($_POST['action']) && $_POST['action'] == 'Assign Site To Project'){
		
		$projects = getAllProjects();
		$sites = getAllSites();

		include 'assignSite.html.php';
		exit();
	}
	
	if(isset($_GET['assignSite'])){
	
		assignSite();

		header('Location: .');
		exit();
	}
?>