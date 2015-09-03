<?php
	if(isset($_POST['action']) && $_POST['action'] == 'Create A Form'){
	
		$forms = getAllForms();
		
		include 'createForm.html.php';
		exit();
	}
	
	if(isset($_GET['addForm'])){
		createForm();
		header('Location: .');
		exit();
	}
?>