<?php
if(isset($_POST['action']) && $_POST['action'] == 'View Data'){

		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		
		$projectName = $_POST['projectName'];
		$projectId = $_POST['projectId'];
		
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
				$sql = 'SELECT name, id FROM site WHERE project_id = :projectId';
				$s = $pdo->prepare($sql);
				$s->bindValue(':projectId', $_POST['projectId']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching sites for project';// . $e->getMessage();
				include 'error.html.php';
				exit();
			}
			
			foreach($s as $row){
				$sites[] = array('name' =>$row['name'], 'siteId' => $row['id']);
			}
		}else{
				$sites[] = array('name' =>'No sites for this project', 'siteId' => 0);
		}

		try{
			$sql = 'SELECT COUNT(*) FROM data WHERE project_id = :projectId';
			$s = $pdo->prepare($sql);
			$s->bindValue(':projectId', $_POST['projectId']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error counting data';
			include 'error.html.php';
			exit();
		}
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = 'SELECT form_input_id, value, site_id, lat, lon, time, submitted_by
				FROM data WHERE project_id = :projectId';
				$s = $pdo->prepare($sql);
				$s->bindValue(':projectId', $_POST['projectId']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching data';
				include 'error.html.php';
				exit();
			}
			foreach($s as $row){
				$data[] = array('inputId' =>$row['form_input_id'], 'value' => $row['value'], 'siteId' => $row['site_id'],
				'lat' => $row['lat'], 'lon' => $row['lon'], 'time' => $row['time'], 'submittedBy' => $row['submitted_by']);
			}
			
			try{
				$sql = 'SELECT id, input_name, input_type, form_id FROM form_input WHERE id = :inputId';
				$s = $pdo->prepare($sql);
				foreach($data as $datum){
					$s->bindValue(':inputId', $datum['inputId']);
					$s->execute();
					foreach($s as $row){
						$inputs[] = array('name' =>$row['input_name'], 'type' => $row['input_type'],
						'formId' => $row['form_id'], 'inputId' => $row['id']);
					}
				}
			}catch(PDOException $e){
				$error = 'Error fetching inputs';
				include 'error.html.php';
				exit();
			}

			
			try{
				$sql = 'SELECT form_name, id FROM form';
				$s = $pdo->prepare($sql);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching forms';
				include 'error.html.php';
				exit();
			}
			foreach($s as $row){
				$forms[] = array('name' =>$row['form_name'], 'formId' => $row['id']);
			}
			
			try{
				$sql = 'SELECT first_name, last_name, id FROM user';
				$s = $pdo->prepare($sql);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching users';
				include 'error.html.php';
				exit();
			}
			foreach($s as $row){
				$users[] = array('firstName' =>$row['first_name'], 'lastName' =>$row['last_name'], 'id' => $row['id']);
			}
		
		}else{
			$data[] = array('inputId' => 0, 'value' => 'None', 'siteId' => 0, 'lat' => 0,
			'lon' => 0, 'time' => 0, 'submittedBy' => 0 );
			$inputs[] = array('name' => 'None', 'type' => 'None',
				'formId' => 0, 'inputId' => 0);
			$forms[] = array('name' => 'None', 'formId' => 0);
			$users[] = array('firstName' => 'None', 'lastName' => 'None', 'id' => 0);
		}
		
		try{
			$sql = 'SELECT COUNT(*) FROM image WHERE project_id = :projectId';
			$s = $pdo->prepare($sql);
			$s->bindValue(':projectId', $_POST['projectId']);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error counting images';
			include 'error.html.php';
			exit();
		}
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = 'SELECT link, name, site_id, time, submitted_by FROM image WHERE project_id = :projectId';
				$s = $pdo->prepare($sql);
				$s->bindValue(':projectId', $_POST['projectId']);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching images';
				include 'error.html.php';
				exit();
			}
			foreach($s as $row){
				$images[] = array('link' =>$row['link'], 'name' => $row['name'], 'siteId' => $row['site_id'],
				'time' => $row['time'], 'submittedBy' => $row['submitted_by']);
			}
		}else{
				$images[] = array('link' => '', 'name' => 'None', 'siteId' => 0,
				'time' => 0, 'submittedBy' => 0);
		}
		
		include 'viewData.html.php';
		exit();
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'Download As CSV'){
	
		$csvArray = array();
		$csvArray[] = array('Site Names', 'Form Names', 'Input Names', 'Input Values','Lat', 'Lon', 'Time',
		'User');
		for($i = 0; $i < count($_POST['siteNames']); $i++){
			$csvArray[] = array($_POST['siteNames'][$i], $_POST['formNames'][$i], $_POST['inputNames'][$i], 
			$_POST['values'][$i],$_POST['lats'][$i], $_POST['lons'][$i], $_POST['times'][$i], $_POST['names'][$i]);
			
		}
		
		$string = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $_POST['projectName']);
		$f = fopen('php://output', 'w');
		foreach($csvArray as $line){
			fputcsv($f, $line);
		}
		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename="' . $string . '.csv";');
		fpassthru($f);
		exit();				
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'Download Image'){
	
		$string = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $_POST['imageSrc']);
		$downloadString = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $_POST['imageUserName']);
		
		if(preg_match('/^image\/p?jpeg$/i', $_POST['imageSrc'])){
			$ext = '.jpg';
		}else if(preg_match('/^image\/p?jpg$/i', $_POST['imageSrc'])){
			$ext = '.jpg';
		}else if(preg_match('/^image\/gif$/i', $_POST['imageSrc'])){
			$ext = '.gif';
		}else if(preg_match('/^image\/(x-)?png$/i', $_POST['imageSrc'])){
			$ext = '.png';
		}else{
			$ext = '.unknown';
		}
		
		$error = $downloadString . $ext;
		include 'error.html.php';
		exit();
		
		
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename="' . $string . '";');
		readfile($string);
		exit();				
	}
?>