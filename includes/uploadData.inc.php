<?php
	if(isset($_POST['action']) && $_POST['action'] == 'Upload Data'){
	
		$projectName = $_POST['projectName'];
		$projectId = $_POST['projectId'];
		
		$sites = getSitesForProject();
		$results = getFormsForProject();
		$forms = $results[0];
		$inputs = $results[1];
		$dropdowns = $results[2];

		include 'uploadData.html.php';
		exit();
	}
	
	if(isset($_GET['uploadData'])){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbTest.inc.php';
		if(isset($_POST['sites'])){
			$siteId = $_POST['sites'];
		}else{
			$siteId = 0;
		}
		if(isset($_POST['lat'])){
			$lat = $_POST['lat'];
		}else{
			$lat = 0;
		}
		if(isset($_POST['lon'])){
			$lon = $_POST['lon'];
		}else{
			$lon = 0;
		}
	
		if($_POST['forms'] != ''){
			try{
				$sql = 'INSERT INTO data SET
					form_input_id = :formInputId,
					value = :value,
					site_id = :siteId,
					lat = :lat,
					lon = :lon,
					submitted_by = :userId,
					project_id = :projectId';
				$s = $pdo->prepare($sql);
				
				foreach($_POST as $key => $value){
					if($key == 'sites' || $key == 'forms' || $key == 'userId' || $key == 'projectId'
					|| substr($key, 0, 9) == 'imageName' || $key == 'lat'|| $key == 'lon'){
						;
					}else{
						$s->bindValue(':formInputId', $key);
						$s->bindValue(':value', $value);
						$s->bindValue(':siteId', $siteId);
						$s->bindValue(':userId', $_POST['userId']);
						$s->bindValue(':lat', $lat);
						$s->bindValue(':lon', $lon);
						$s->bindValue(':projectId', $_POST['projectId']);
						$s->execute();
					}
				}
			}catch(PDOException $e){
				$error = 'Error uploading data' . $e->getMessage();
				include 'error.html.php';
				exit();
			}
		}
		$i = 0;
		foreach($_FILES as $file){
			if($file['error'] == 0){
				if(preg_match('/^image\/p?jpeg$/i', $_FILES['image' . $i]['type'])  ||
					preg_match('/^image\/gif$/i', $_FILES['image' . $i]['type']) ||
					preg_match('/^image\/(x-)?png$/i', $_FILES['image' . $i]['type'])){
					
					if(preg_match('/^image\/p?jpeg$/i', $_FILES['image' . $i]['type'])){
						$ext = '.jpg';
					}else if(preg_match('/^image\/gif$/i', $_FILES['image' . $i]['type'])){
						$ext = '.gif';
					}else if(preg_match('/^image\/(x-)?png$/i', $_FILES['image' . $i]['type'])){
						$ext = '.png';
					}else{
						$ext = '.unknown';
					}
					
					$filename = 'C:/wamp/www/st/uploads/' . time() . $_SERVER['REMOTE_ADDR'] . $i . $ext;
					$link = 'uploads/' . time() . $_SERVER['REMOTE_ADDR'] . $i . $ext;
					
					if(!is_uploaded_file($_FILES['image' . $i]['tmp_name']) || 
						!copy($_FILES['image' . $i]['tmp_name'], $filename)){
							$error = "Could not save file as $filename";
							include 'error.html.php';
							exit();
						}	
					
				}else{
					$error = 'Please submit a JPEG, GIF, or PNG image file';
					include 'error.html.php';
					exit();
				}
				
					try{
						$sql = 'INSERT INTO image SET
							link = :fileName,
							name = :imageName,
							site_id = :siteId,
							submitted_by = :userId,
							project_id = :projectId';
						$s = $pdo->prepare($sql);
						$s->bindValue(':fileName', $link);
						$s->bindValue(':imageName', $_POST['imageName' . $i]);
						$s->bindValue(':siteId', $siteId);
						$s->bindValue(':userId', $_POST['userId']);
						$s->bindValue(':projectId', $_POST['projectId']);
						$s->execute();
					}catch(PDOException $e){
						$error = 'Error uploading image' . $e->getMessage();
						include 'error.html.php';
						exit();
					}
			}
			$i++;
		}
		header('Location: .');
		exit();
	}
?>