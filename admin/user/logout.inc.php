<?php
	if(isset($_POST['action']) && $_POST['action'] == 'logout'){
		unset($_SESSION['loggedIn']);
		unset($_SESSION['id']);
		unset($_SESSION['firstName']);
		unset($_SESSION['lastName']);
		unset($_SESSION['email']);
		unset($_SESSION['phone']);
		if(isset($_SESSION['superAdmin'])){
				unset($_SESSION['superAdmin']);
		}
		if(isset($_SESSION['projectAdmin'])){
				unset($_SESSION['projectAdmin']);
		}
		if(isset($_SESSION['adminProjects'])){
				unset($_SESSION['adminProjects']);
		}
		if(isset($_SESSION['projectUser'])){
				unset($_SESSION['projectUser']);
		}
		if(isset($_SESSION['userProjects'])){
				unset($_SESSION['userProjects']);
		}
		header('Location: ../..');
		exit();
	}
?>