<?php
/*
	function userIsLoggedIn(){
		if(isset($_POST['action']) && $_POST['action'] == 'login'){
			if(!isset($_POST['email']) || $_POST['email'] == ''
			|| !isset($_POST['password']) || $_POST['password'] == ''){
				$GLOBALS['loginError'] = 'Please fill in both fields';
				return FALSE;
			}
			
			$password = md5($_POST['password'] . 'ionic');
			if(databaseContainsUser($_POST['email'], $password)){
				session_start();
				$_SESSION['loggedIn'] = TRUE;
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['password'] = $password;
				return TRUE;
			}else{
				session_start();
				unset($_SESSION['loggedIn']);
				unset($_SESSION['email']);
				unset($_SESSION['password']);
				$GLOBALS['loginError'] = 'The email address or password was incorrect';
				return FALSE;
			}
			
		}
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'logout'){
		session_start();
		unset($_SESSION['loggedIn']);
		unset($_SESSION['email']);
		unset($_SESSION['password']);
		header('Location: ' . $_POST['goto']);
		exit();
	}
	session_start();
	if(isset($_SESSION['loggedIn'])){
		return databaseContainsUser($_SESSION['email'], $_SESSION['password']);
	}
*/
/*
	function databaseContainsUser($email, $password){
		include 'db.inc.php';
		
		try{
			$sql = 'SELECT COUNT(*) FROM user WHERE email = :email AND password = :password';
			$s = $pdo->prepare($sql);
			$s->bindValue(':email', $email);
			$s->bindValue(':password', $password);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error searching for user';
			include 'error.html.php';
			exit();
		}
		
		$row = $s->fetch();
		if($row[0] > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
*/
	function initUser($email){
		include 'db.inc.php';
		
		try{
			$sql = 'SELECT id, first_name, last_name, email, phone, password FROM user WHERE email = :email';
			$s = $pdo->prepare($sql);
			$s->bindValue(':email', $email);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error in initUser';
			include 'error.html.php';
			exit();
		}
		
		$row = $s->fetch();
		if($row[0] > 0){
			$_SESSION['loggedIn'] = FALSE;
			$_SESSION['id'] = $row['id'];
			$_SESSION['firstName'] = $row['first_name'];
			$_SESSION['lastName'] = $row['last_name'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['phone'] = $row['phone'];
			$_SESSION['password'] = $row['password'];
		}else{
			return FALSE;
		}
		
		try{
			$sql = "SELECT COUNT(*) FROM super_admin WHERE user_id = :id";
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_SESSION['id']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error searching for super admin';
			include 'error.html.php';
			exit();
		}
		$row = $s->fetch();
		if($row[0] > 0){
			$_SESSION['superAdmin'] = TRUE;
			return TRUE;
		}
		
		try{
			$sql = "SELECT COUNT(*) FROM project_admin WHERE user_id = :id";
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_SESSION['id']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error searching for project admin';
			include 'error.html.php';
			exit();
		}
		
		$row = $s->fetch();
		if($row[0] > 0){
			$_SESSION['projectAdmin'] = TRUE;
		}
		
		try{
			$sql = "SELECT COUNT(*) FROM project_user WHERE user_id = :id";
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_SESSION['id']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error searching for project user';
			include 'error.html.php';
			exit();
		}
		
		$row = $s->fetch();
		if($row[0] > 0){
			$_SESSION['projectUser'] = TRUE;
			return TRUE;
		}
		
		return TRUE;
		
	}
	
/*	
	function userIsSuperAdmin($id){
		include 'db.inc.php';
		try{
			$sql = "SELECT COUNT(*) FROM user INNER JOIN super_admin On user.id = super_admin.user_id
			WHERE email = :email AND super_admin.user_id = :id";
			$s = $pdo->prepare($sql);
			$s->bindValue(':email', $_SESSION['email']);
			$s->bindValue(':id', $id);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error searching for super admin';
			include 'error.html.php';
			exit();
		}
		
		$row = $s->fetch();
		if($row[0] > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
*/
	
?>