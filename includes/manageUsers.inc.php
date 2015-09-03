<?php
	if(isset($_POST['action']) && $_POST['action'] == 'Manage User Projects And Roles'){
	
		$users = getAllUsers();
		$projects = getAllProjects();
		$projectUsers = getProjectUsers();
		
		include 'view.html.php';
		exit();
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'Assign User To Project'){
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$userId = $_POST['id'];
		$email = $_POST['email'];
		
		$projects = getAllProjects();
		$projectUsers = getProjectUsers();
			
		include 'assignUser.html.php';
		exit();
	}
	
	if(isset($_GET['assignUser'])){
	
		assignUserProjects();

		header('Location: .');
		exit();	
	}

	if(isset($_POST['action']) && $_POST['action'] == 'Assign User Roles'){
	
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$userId = $_POST['id'];
		$email = $_POST['email'];
		$super_admin = $_POST['super_admin'];
		
		$projects = getAllProjects();
		$projectUsers = getProjectUsers();
			
		include 'assignAdmin.html.php';
		exit();
	}
	
	if(isset($_GET['assignAdmin'])){
		
		if(isset($_POST['assignProjects'])){
		echo '<pre' . print_r($_POST) . '</pre>';
			assignProjectAdmin();
		}
		
		if(isset($_POST['removeProjects'])){
			try{
				$sql = 'DELETE FROM project_admin WHERE user_id = :userId AND project_id = :projectId';
				$s = $pdo->prepare($sql);
				foreach($_POST['removeProjects'] as $removeProject){
					$s->bindValue(':userId', $_POST['id']);
					$s->bindValue(':projectId', $removeProject);
					$s->execute();
				}
			}catch(PDOException $e){
				$error = 'Error deleting project users' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}
		
		if(isset($_POST['makeSuperAdmin'])){
			try{
				$sql = 'INSERT INTO super_admin SET user_id = :userId';
				$s = $pdo->prepare($sql);
				$s->bindValue(':userId', $_POST['id']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error updating super admin' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}
		
		if(isset($_POST['removeSuperAdmin'])){
			try{
				$sql = 'DELETE FROM super_admin WHERE user_id = :userId';
				$s = $pdo->prepare($sql);
				$s->bindValue(':userId', $_POST['id']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error deleting super admin' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}
		
		header('Location: .');
		exit();	
	}
?>