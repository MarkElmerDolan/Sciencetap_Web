<?php
 include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
	<title>Log In</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body id="bg">
<div class="container-fluid">
<div class="row">
<img src="../img/logo.png" id="loginLogo"/>
<form action="" method="post">
	<div class="loginItem">
		<label for="email">Email: <input type="text" name="email" id="email"></label>
	</div>
	<div class="loginItem">
		<label for="password">Password: <input type="password" name="password" id="password"></label>
	</div>
	<div class="loginItem">
		<input type="hidden" name="action" value="login">
		<input type="submit" value="Login" class="btn btn-md btn-info">
	</div>
</form>
<p><?php
	if(isset($error)){
		echo $error;
	}
	?>
</p>
</div>
<script src="../js/jquery-2.1.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</div>
</body>
</html>