<?php	
	if(isset($_POST['action']) && $_POST['action'] == 'Create A User'){
		include 'createUser.html.php';
		exit();
	}
	
	if(isset($_GET['addUser'])){
	
		createUser();
		
		header('Location: .');
		exit();
	}
?>