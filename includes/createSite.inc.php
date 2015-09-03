<?php	
	if(isset($_POST['action']) && $_POST['action'] == 'Create A Site'){
	
		$projects = getAllProjects();
		include 'createSite.html.php';
		exit();
	}
	
	if(isset($_GET['createSite'])){
	
		createSite();
	
		header('Location: .');
		exit();
	}
?>