<?php
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] == FALSE){
			include 'login.html.php';
			exit();
		}
	}else{
		include 'login.html.php';
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Account</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container-fluid">
<h3>My Account</h3>
<table class="table table-bordered">
	<thead>
		<th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $_SESSION['firstName']; ?></td>
			<td><?php echo $_SESSION['lastName']; ?></td>
			<td><?php echo $_SESSION['email']; ?></td>
			<td><?php echo $_SESSION['phone']; ?></td>
	</tbody>
</table>

<h3>My Projects</h3>
<?php 
	if($projects[0]['project_id'] != 0){
		echo '<dl>';
		foreach($projects as $project){
			echo '<dt>Name: ' . $project['project_name'] . '</dt>';
			echo '<dd>Description: ' . $project['project_description'] . '</dd>';
		}
		echo '</dl>';
	}else{
		echo '<h4 class="bg-warning">' . $projects[0].['project_description'] .'</h4>';
	}
?>
<?php if(isset($_SESSION['superAdmin'])){
	echo '<h4>Sciencetap Role: Super Admin</h4>';
}elseif(isset($_SESSION['projectAdmin'])){
	echo '<h4>Sciencetap Role: Project Admin</h4>';
}else{
	echo '<h4>Sciencetap Role: Project User</h4>';
}
?>
<form action="" method="post">
	<div>
		<input type="hidden" name="firstName" value="<?php htmlout($_SESSION['firstName']); ?>">
		<input type="hidden" name="lastName" value="<?php htmlout($_SESSION['lastName']); ?>">
		<input type="hidden" name="email" value="<?php htmlout($_SESSION['email']); ?>">
		<input type="hidden" name="id" value="<?php htmlout($_SESSION['id']); ?>">
		<input class="btn btn-success btn-block" type="submit" name="action" value="Edit My Info">
	</div>
</form>
<br>
<a class="btn btn-success btn-block" href="?setPassword">Set Your Password</a>
<br>
<a class="btn btn-primary btn-block" href=".">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
<script src="../../js/jquery-2.1.3.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
</div>
</body>
</html>