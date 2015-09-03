<?php
	if(isset($_POST['action']) && $_POST['action'] == 'View And Assign Forms To Project'){

		$forms = getAllForms();
		$formInputs = getAllFormInputs();
		$dropdowns = getAllDropdowns();
		$projectForms = getAllProjectForms();
		$projects = getAllProjects();

		include 'view.html.php';
		exit();
	}
	
	
	if(isset($_POST['action']) && $_POST['action'] == 'Assign Form To Project'){
	
		$formId = $_POST['id'];
		$formName = $_POST['formName'];
		
		$projects = getAllProjects();
		$projectForms = getAllProjectForms();
		
		include 'assignForm.html.php';
		exit();
	}
	
	if(isset($_GET['assignForm'])){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		
		if(isset($_POST['assignProjects'])){
			assignFormToProjects();
		}
		if(isset($_POST['removeProjects'])){
			removeFormFromProjects();
		}
		header('Location: .');
		exit();	
	}
?>