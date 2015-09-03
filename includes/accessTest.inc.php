<?php

	function initUser($email){
		include 'dbTest.inc.php';
		
		try{
			$sql = "SELECT COUNT(*) FROM user WHERE email = :email";
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
			try{
				$sql = 'SELECT user_id, first_name, last_name, email, phone, password,
				super_admin FROM user WHERE email = :email';
				$s = $pdo->prepare($sql);
				$s->bindValue(':email', $email);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in initUser';
				include 'error.html.php';
				exit();
			}
			$row = $s->fetch();
			$_SESSION['loggedIn'] = FALSE;
			$_SESSION['id'] = $row['user_id'];
			$_SESSION['firstName'] = $row['first_name'];
			$_SESSION['lastName'] = $row['last_name'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['phone'] = $row['phone'];
			$_SESSION['password'] = $row['password'];
			if($row['super_admin']){
				$_SESSION['superAdmin'] = TRUE;
			}
		}else{
			return FALSE;
		}
		
		
		try{
			$sql = "SELECT COUNT(*) FROM project_user WHERE user_id = :id";
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
			try{
				$sql = "SELECT project_id, project_admin FROM project_user WHERE user_id = :id";
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $_SESSION['id']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error searching for project admin';
				include 'error.html.php';
				exit();
			}
			foreach($s as $row){
				$projectUser[] = array('project_id' => $row['project_id'],
				'project_admin' => $row['project_admin']);
			}
		}
		
		if(isset($projectUser)){
			foreach($projectUser as $projectAdmin){
				if($projectAdmin['project_admin']){
					$_SESSION['projectAdmin'] = TRUE;
					return TRUE;
				}
			}
			$_SESSION['projectUser'] = TRUE;
			return TRUE;
		}
		return TRUE;
	}
	
?>