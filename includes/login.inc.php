<?php
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] == TRUE){

			$projects = getUserProjects($_SESSION['id']);
			
			include 'display.html.php';
			exit();
		}
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'login'){
		if(initUser($_POST['email'])){
			if($_SESSION['password'] == ''){
				$warning = 'Please Set Your Password!!!';
				$_SESSION['loggedIn'] = TRUE;
				unset($_SESSION['password']);
				
				$projects = getUserProjects($_SESSION['id']);
				
				include 'display.html.php';
				exit();
			}else{
				include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
				$password= md5($_POST['password'] . 'ionic');
				try{
					$sql = 'SELECT COUNT(*) FROM user WHERE email = :email AND password = :password';
					$s = $pdo->prepare($sql);
					$s->bindValue(':email', $_SESSION['email']);
					$s->bindValue(':password', $password);
					$s->execute();
				}catch(PDOException $e){
					$error = 'Error checking existing password';
					include 'error.html.php';
					exit();
				}
				
				$row = $s->fetch();
				if($row[0] > 0){
					$_SESSION['loggedIn'] = TRUE;
					unset($_SESSION['password']);
					
					$projects = getUserProjects($_SESSION['id']);
					
					include 'display.html.php';
					exit();
				}else{
					$error ='Password or email was incorrect';
					unset($_SESSION['password']);
					include 'login.html.php';
					exit();
				}
			}
		}else{
			$error ='Credentials did not match an existing account';
			include 'login.html.php';
			exit();
		}
	}
	?>