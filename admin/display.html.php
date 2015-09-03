<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Manage Sciencetap</title>
	<link href="../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
<div class="row">
<!-- <h1>Admin Functions</h1> -->
	<a class="btn btn-success btn-block" href="project/"><h5>Manage Projects and Sites</h5></a>
	<a class="btn btn-success btn-block" href="user/"><h5>Manage Users and Admins</h5></a>
	<a class="btn btn-success btn-block" href="forms/"><h5>Manage Forms</h5></a>
	<br>
	<br>
</div>
<div class="row">
<a class="btn btn-primary btn-block" href="..">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
</div>
<script src="../../js/jquery-2.1.3.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
</div>
</body>
</html>