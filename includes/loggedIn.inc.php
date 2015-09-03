<?php
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] == FALSE){
			header('Location: ..');
			exit();
		}
	}else{
		header('Location: ..');
		exit();
	}
?>