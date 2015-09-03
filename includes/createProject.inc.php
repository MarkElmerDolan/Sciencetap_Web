<?php
	if(isset($_POST['action']) && $_POST['action'] == 'Create A Project'){
		include 'createProject.html.php';
		exit();
	}
	
	if(isset($_GET['addProject'])){
	
		createProject();

		header('Location: .');
		exit();
	}
?>