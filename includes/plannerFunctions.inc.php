<?php
	
	function getThoughts(){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbPlanner.inc.php';
		try{
			$sql = ('SELECT COUNT(*) FROM thought');
				$s = $pdo->prepare($sql);
				$s->execute();
		}catch(PDOException $e){
				$error = 'Error counting thoughts' . $e->getMessage();
				include 'error.html.php';
				exit();
		}
		$row = $s->fetch();
		if($row[0] > 0){
			try{
				$sql = ('SELECT thought_id, thought_message, thought_active, thought_time_created FROM thought');
				$s = $pdo->prepare($sql);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error fetching thoughts' . $e->getMessage();
				include 'error.html.php';
				exit();
			}

			foreach($s as $row){
				$thoughts[] = array('thought_id' => $row['thought_id'],
				'thought_message' => $row['thought_message'],
				'thought_active' => $row['thought_active'],
				'thought_time_created' => $row['thought_time_created']);
			}
		}else{
				$thoughts[] = array('thought_id' => 0,
				'thought_message' => 'No thoughts',
				'thought_active' => 1,
				'thought_time_created' => 'None');
		}
		return $thoughts;
	}
	
	function addThought($message){
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/dbPlanner.inc.php';
		
		try{
			$sql = 'INSERT INTO thought SET thought_message = :thought_message, thought_active = 1';
			$s = $pdo->prepare($sql);
			$s->bindValue(':thought_message', $message);
			$s->execute();
		}catch(PDOException $e){
			$error = 'Error updating thoughts'. $e->getMessage();
			include 'error.html.php';
			exit();
		}
	}
?>