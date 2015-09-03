<?php
	
	function getUserProjects($id){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = ('SELECT COUNT(*) FROM user INNER JOIN
				project_user ON user.user_id = project_user.user_id INNER JOIN
				project ON project_user.project_id = project.project_id WHERE user.user_id = :id');
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
		}catch(PDOException $e){
				$error = 'Error fetching project for display' . $e->getMessage();
				include 'error.html.php';
				exit();
		}
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = ('SELECT project.project_id, project.project_name, project.project_description,
				project.project_time_created FROM user INNER JOIN project_user ON 
				user.user_id = project_user.user_id INNER JOIN project ON
				project_user.project_id = project.project_id WHERE user.user_id = :id');
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching project for display user' . $e->getMessage();
				include 'error.html.php';
				exit();
			}

			foreach($s as $row){
				$projects[] = array('project_id' => $row['project_id'],
				'project_name' => $row['project_name'],
				'project_description' => $row['project_description'],
				'time_created' => $row['project_time_created']);
			}
		}else{
			$projects[] = array('project_id' => 0,
				'project_name' => 'None',
				'project_description' => 'No projects Assigned to this user',
				'time_created' => 0);
		}
		return $projects;
	}
	
	function getAllProjects(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = ('SELECT COUNT(*) FROM project');
				$s = $pdo->prepare($sql);
				$s->execute();
		}catch(PDOException $e){
				$error = 'Error fetching all projects for display' . $e->getMessage();
				include 'error.html.php';
				exit();
		}
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = ('SELECT project.project_id, project.project_name, project.project_description,
				project.project_time_created FROM project');
				$s = $pdo->prepare($sql);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching all projects for display' . $e->getMessage();
				include 'error.html.php';
				exit();
			}

			foreach($s as $row){
				$projects[] = array('project_id' => $row['project_id'],
				'project_name' => $row['project_name'],
				'project_description' => $row['project_description'],
				'time_created' => $row['project_time_created']);
			}
		}else{
			$projects[] = array('project_id' => 0,
				'project_name' => 'None',
				'project_description' => 'No projects Assigned to this user',
				'time_created' => 0);
		}
		return $projects;
	}
	
	function getAllSites(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = "SELECT COUNT(*) FROM site";
			$s = $pdo->prepare($sql);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error counting sites';
			include 'error.html.php';
			exit();
		}
			
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = "SELECT site_id, site_name, site_description, site_lat,
					site_lon, project_id FROM site";
				$s = $pdo->prepare($sql);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching sites';
				include 'error.html.php';
				exit();
			}
			foreach($s as $row){
				$sites[] = array('site_id' => $row['site_id'],'site_name' => $row['site_name'],
				'site_description' => $row['site_description'],'site_lat' => $row['site_lat'],
				'site_lon' => $row['site_lon'],'project_id' => $row['project_id']);
			}
		}else{
				$sites[] = array('site_id' => 0,'site_name' => 'No sites',
				'site_description' => 'none','site_lat' => 0,'site_lon' => 0,'project_id' => 0);
		}
		
		return $sites;
	}
	
	function getAllForms(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = "SELECT COUNT(*) FROM form";
			$s = $pdo->prepare($sql);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error counting forms';
			include 'error.html.php';
			exit();
		}
			
		$row = $s->fetch();
		if($row[0] > 0){
			try{
			$result = $pdo->query('SELECT form_name, form_id, form_time_created, user_id, form_description
			FROM form');
			}catch(PDOException $e){
				$error = 'Error fetching forms from library';// . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			
			foreach($result as $row){
				$forms[] = array('name' => $row['form_name'], 'formId' => $row['form_id'], 'form_time_created' => $row['form_time_created'], 'user_id' => $row['user_id'], 'form_description' => $row['form_description']);
			}
		}else{
			$forms[] = array('name' => 'None', 'formId' => 0, 'form_time_created' => 0, 'user_id' => 'None', 'form_description' => 'None');
		}
		
		return $forms;
	}
	
	function getAllFormInputs(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
	
		try{
			$sql = 'SELECT form_input_id, form_input_name, form_input_type, form_id FROM form_input';
			$s = $pdo->prepare($sql);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error fetching form inputs' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
		
		foreach($s as $row){
			$formInputs[] = array('form_input_id' => $row['form_input_id'], 'form_input_name' => $row['form_input_name'], 
			'form_input_type' => $row['form_input_type'], 'form_id' => $row['form_id']);
		}
		
		return $formInputs;
	}
	
	function getAllDropdowns(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'SELECT form_input_id, dropdown_value FROM dropdown';
			$s = $pdo->prepare($sql);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error fetching dropdowns' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
		
		foreach($s as $row){
			$dropdowns[] = array('form_input_id' => $row['form_input_id'], 'dropdown_value' => $row['dropdown_value']);
		}
		
		return $dropdowns;
	}
	
	function getAllProjectForms(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = "SELECT COUNT(*) FROM project_form";
			$s = $pdo->prepare($sql);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error counting project_form';
			include 'error.html.php';
			exit();
		}
			
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = 'SELECT form_id, project_id FROM project_form';
				$s = $pdo->prepare($sql);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching forms for projects' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			foreach($s as $row){
			$projectForms[] = array('form_id' => $row['form_id'], 'project_id' => $row['project_id']);
			}	
			
		}else{
			$projectForms[] = array('form_id' => 0, 'project_id' => 0);
		}
		
		return $projectForms;
	}
	
	function getAllUsers(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$result = $pdo->query('SELECT user_id, first_name, last_name, email, phone,
			super_admin FROM user');
		}catch(PDOException $e){
			$error = 'Error fetching users';// . $e->getMessage();
			include 'error.html.php';
			exit();
		}
		
		foreach($result as $row){
			$users[] = array('id' =>$row['user_id'], 'firstName' => $row['first_name'],
			'lastName' => $row['last_name'], 'email' => $row['email'], 'phone' => $row['phone'],
			'super_admin' => $row['super_admin']);
		}
		
		return $users;
	}
	
	function getProjectUsers(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = "SELECT COUNT(*) FROM project_user";
			$s = $pdo->prepare($sql);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error counting project_user';
			include 'error.html.php';
			exit();
		}
			
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = 'SELECT user_id, project_id, project_admin FROM project_user';
				$s = $pdo->prepare($sql);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching project users' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
		
			foreach($s as $row){
				$projectUsers[] = array('userId' => $row['user_id'], 'projectId' => $row['project_id'],
				'project_admin' => $row['project_admin']);
			}
		}else{
			$projectUsers[] = array('userId' => 0, 'projectId' => 0,
				'project_admin' => 0);
		}
		
		return $projectUsers;
	}
	
	function loginUserProjects($projectUser){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = ('SELECT project_name, project_id, project_description, project_time_created FROM 
			project WHERE project_id = :project_id');
			foreach($projectUser as $project){
				$s = $pdo->prepare($sql);
				$s->bindValue(':project_id', $project['project_id']);
				$s->execute();
				
				foreach($s as $row){
					$projects[] = array('project_id' => $row['project_id'],
					'project_name' => $row['project_name'],
					'project_description' => $row['project_description'],
					'time_created' => $row['project_time_created']);
				}
			}
		}catch(PDOException $e){
			$error = 'Error fetching projects for user' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
		return $projects;
	}
	
	function createProject(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'INSERT INTO project SET
				project_name = :name,
				project_description = :description';
			$s = $pdo->prepare($sql);
			$s->bindValue(':name', $_POST['name']);
			$s->bindValue(':description', $_POST['description']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error adding project';// . $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}
	
	function createSite(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		if(isset($_POST['projects'])){
			try{
				$sql = 'INSERT INTO site SET site_name = :name, site_description = :description, 
				site_lat = :lat, site_lon = :lon, project_id = :projectId';
				$s = $pdo->prepare($sql);
				$s->bindValue(':name', $_POST['name']);
				$s->bindValue(':description', $_POST['description']);
				$s->bindValue(':lat', $_POST['lat']);
				$s->bindValue(':lon', $_POST['lon']);
				$s->bindValue(':projectId', $_POST['projects']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error updating sites';// . $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}else{
			try{
				$sql = 'INSERT INTO site SET site_name = :name, site_description = :description, 
				site_lat = :lat, site_lon = :lon, project_id = :projectId';
				$s = $pdo->prepare($sql);
				$s->bindValue(':name', $_POST['name']);
				$s->bindValue(':description', $_POST['description']);
				$s->bindValue(':lat', $_POST['lat']);
				$s->bindValue(':lon', $_POST['lon']);
				$s->bindValue(':projectId', 0);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error updating sites without project ID';// . $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}
	}
	
	function createUser(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'INSERT INTO user SET
				first_name = :firstName,
				last_name = :lastName,
				email = :email,
				phone = :phone';
			$s = $pdo->prepare($sql);
			$s->bindValue(':firstName', $_POST['firstName']);
			$s->bindValue(':lastName', $_POST['lastName']);
			$s->bindValue(':email', $_POST['email']);
			$s->bindValue(':phone', $_POST['phone']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error creating user'. $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}
	
	function editProject(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'UPDATE project SET project_name = :name, project_description = :description 
			WHERE project_id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':name', $_POST['name']);
			$s->bindValue(':description', $_POST['description']);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error updating project'. $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}

	function editSite(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'UPDATE site SET site_name = :name, site_description = :description, site_lat = :lat,
			site_lon = :lon WHERE site_id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':name', $_POST['name']);
			$s->bindValue(':description', $_POST['description']);
			$s->bindValue(':lat', $_POST['lat']);
			$s->bindValue(':lon', $_POST['lon']);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error updating site'. $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}
	
	function updateUser(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'UPDATE user SET
				first_name = :firstName,
				last_name = :lastName,
				phone = :phone,
				email = :email
				WHERE user_id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':firstName', $_POST['firstName']);
			$s->bindValue(':lastName', $_POST['lastName']);
			$s->bindValue(':phone', $_POST['phone']);
			$s->bindValue(':email', $_POST['email']);
			$s->bindValue(':id', $_POST['id']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error updating my account'. $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}
	
	function assignSite(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		if(isset($_POST['projects'])){
			try{
				$sql = 'UPDATE site SET project_id = :projectId WHERE site_id = :id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':projectId', $_POST['projects']);
				$s->bindValue(':id', $_POST['sites']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error assigning site to project'. $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}
	}
	
	function assignUserProjects(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		if(isset($_POST['assignProjects'])){
			try{
				$sql = 'INSERT INTO project_user SET user_id = :userId, project_id = :projectId, project_admin = 0';
				$s = $pdo->prepare($sql);
				foreach($_POST['assignProjects'] as $assignProject){
					$s->bindValue(':userId', $_POST['id']);
					$s->bindValue(':projectId', $assignProject);
					$s->execute();
				}
			}catch(PDOException $e){
				$error = 'Error updating project users' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}
		
		if(isset($_POST['removeProjects'])){
			try{
				$sql = 'DELETE FROM project_user WHERE user_id = :userId AND project_id = :projectId';
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
	}
	
	function assignProjectAdmin(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'UPDATE project_user SET project_admin = 1 WHERE project_id = :projectId AND user_id = :userId';
			$s = $pdo->prepare($sql);
			foreach($_POST['assignProjects'] as $assignProject){
				$s->bindValue(':userId', $_POST['id']);
				$s->bindValue(':projectId', $assignProject);
				$s->execute();
			}
		}catch(PDOException $e){
			$error = 'Error updating project users' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}
	
	function createForm(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		$dropdownId = array();

		try{
			$sql = 'INSERT INTO form SET form_name = :formName, user_id = :userId, form_description = :form_description';
			$s = $pdo->prepare($sql);
			$s->bindValue(':formName', $_POST['formName']);
			$s->bindValue(':userId', $_POST['userId']);
			$s->bindValue(':form_description', $_POST['form_description']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error updating forms' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
		$formId = $pdo->lastInsertId();	
		
		if(isset($_POST['dataNames']) && isset($_POST['dataTypes'])){
			try{
				$sql = 'INSERT INTO form_input SET
				form_input_name = :inputName, form_input_type = :inputType, form_id = :formId';
				$s = $pdo->prepare($sql);
		
			$i = 0;
			foreach($_POST['dataNames'] as $dataName){
				$s->bindValue(':inputName', $dataName);
				$s->bindValue(':inputType', $_POST['dataTypes'][$i]);
				$s->bindValue(':formId', $formId);
				$s->execute();
				if($_POST['dataTypes'][$i] == 'Dropdown'){
					$dropdownId[] = $pdo->lastInsertId();
				}
				$i++;
			}
			}catch(PDOException $e){
				$error = 'Error updating form input';// . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			
			$i = 0;
			for($k = 0; $k < 20; $k++){
				if(isset($_POST['list' . $k])){
					try{
						$sql = 'INSERT INTO dropdown SET form_input_id = :inputId, dropdown_value = :value';
						$s = $pdo->prepare($sql);
						foreach($_POST['list' . $k] as $list){
							$s->bindValue(':inputId', $dropdownId[$i]);
							$s->bindValue(':value', $list);
							$s->execute();
						}
						$i++;
					}catch(PDOException $e){
						$error = 'Error updating dropdown';// . $e->getMessage();
						include 'error.html.php';
						exit();
					}
				}
			}
		}
	}
	
	function setPassword(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';

		if($_POST['password'] != ''){
			$scrambled = md5($_POST['password'] . 'ionic');
			try{
				$sql = 'UPDATE user SET password = :password WHERE user_id = :id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':password', $scrambled);
				$s->bindValue(':id', $_SESSION['id']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error setting user password';
				include 'error.html.php';
				exit();
			}
		}else{
			$error = 'Password can not be blank';
			include 'setPassword.html.php';
			exit();
		}
	}
	
	function getSitesForProject(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'SELECT COUNT(*) FROM site WHERE site.project_id = :projectId';
			$s = $pdo->prepare($sql);
			$s->bindValue(':projectId', $_POST['projectId']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error counting sites';
			include 'error.html.php';
			exit();
		}
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = 'SELECT site_name, site_id FROM site WHERE project_id = :projectId';
				$s = $pdo->prepare($sql);
				$s->bindValue(':projectId', $_POST['projectId']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching sites for project';// . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			
			foreach($s as $row){
				$sites[] = array('site_name' =>$row['site_name'], 'site_id' => $row['site_id']);
			}
		}else{
				$sites[] = array('name' =>'No sites for this project', 'siteId' => 0);
		}
		
		return $sites;
	}
	
	function getFormsForProject(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'SELECT COUNT(*)FROM form INNER JOIN project_form ON 
			project_form.form_id = form.form_id WHERE project_form.project_id = :projectId';
			$s = $pdo->prepare($sql);
			$s->bindValue(':projectId', $_POST['projectId']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error counting forms';
			include 'error.html.php';
			exit();
		}
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = 'SELECT form_name, form.form_id FROM form
						INNER JOIN project_form ON project_form.form_id = form.form_id WHERE project_form.project_id = :projectId';
				$s = $pdo->prepare($sql);
				$s->bindValue(':projectId', $_POST['projectId']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching forms for project';// . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			
			foreach($s as $row){
				$forms[] = array('form_id' =>$row['form_id'], 'form_name' => $row['form_name']);
			}
		
			try{
				$sql = 'SELECT form_input_id, form_input_name, form_input_type, form_id FROM form_input WHERE form_id = :id';
				$s = $pdo->prepare($sql);
				foreach($forms as $form){
					$s->bindValue(':id', $form['form_id']);
					$s->execute();
					foreach($s as $row){
						$inputs[] = array('form_input_name' => $row['form_input_name'], 'form_input_type' => $row['form_input_type'],
						'form_id' => $row['form_id'], 'form_input_id' => $row['form_input_id']);
					}
				}
			}catch(PDOException $e){
				$error = 'Error fetching inputs assigned to forms' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			
			foreach($inputs as $input){
				if($input['form_input_type'] == 'Dropdown'){
					try{
						$sql = 'SELECT dropdown_value, form_input_id FROM dropdown WHERE form_input_id = :id';
						$s = $pdo->prepare($sql);
						$s->bindValue(':id', $input['inputId']);
						$s->execute();
						foreach($s as $row){
								$dropdowns[] = array('dropdown_value' => $row['dropdown_value'], 'form_input_id' => $row['form_input_id']);
						}
					}catch(PDOException $e){
						$error = 'Error fetching dropdowns assigned to input' . $e->getMessage();
						include 'error.html.php';
						exit();
					}
				}
			}
		}else{
			$forms[] = array('form_id' => '0', 'form_name' => 'No forms for this project');
			$inputs[] = array('form_input_name' => 'No fields', 'form_input_type' => 'none',
						'form_id' => '0', 'form_input_id' => '0');
			
		}
		if(!isset($dropdowns)){
			$dropdowns[] =array('dropdown_value' => 'None', 'form_input_id' => '0');
		}
		
		return array($forms, $inputs, $dropdowns);
	}
	
	function assignFormToProjects(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'INSERT INTO project_form SET form_id = :formId, project_id = :projectId';
			$s = $pdo->prepare($sql);
			foreach($_POST['assignProjects'] as $assignProject){
				$s->bindValue(':formId', $_POST['id']);
				$s->bindValue(':projectId', $assignProject);
				$s->execute();
			}
		}catch(PDOException $e){
			$error = 'Error updating project forms' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}
	
	function removeFormFromProjects(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		try{
			$sql = 'DELETE FROM project_form WHERE form_id = :formId AND project_id = :projectId';
			$s = $pdo->prepare($sql);
			foreach($_POST['removeProjects'] as $removeProject){
				$s->bindValue(':formId', $_POST['id']);
				$s->bindValue(':projectId', $removeProject);
				$s->execute();
			}
		}catch(PDOException $e){
			$error = 'Error deleting project forms' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}
?>