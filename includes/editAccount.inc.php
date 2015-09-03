<?php
	if(isset($_POST['action']) && $_POST['action'] == 'My Account'){
		
		$projects = getUserProjects($_SESSION['id']);
		
		include 'myAccount.html.php';
		exit();
	
	}
	
	if(isset($_GET['setPassword'])){
	
		include 'setPassword.html.php';
		exit();
	}
	
	if(isset($_GET['setPasswordForm'])){
	
		setPassword();
		
		header('Location: .');
		exit();
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'Edit My Info'){
		
		include 'editUserForm.html.php';
		exit();
	}
	
	if(isset($_GET['updateUser'])){
	
		updateUser();
	
		$_SESSION['firstName'] = $_POST['firstName'];
		$_SESSION['lastName'] = $_POST['lastName'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['phone'] = $_POST['phone'];

		header('Location: .');
		exit();
	}
?>