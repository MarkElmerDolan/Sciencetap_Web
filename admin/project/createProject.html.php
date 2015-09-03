<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create A Project</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
	<h3>Create A Project</h3>
	<form action="?addProject" method="post">
		<div class="form-group">
			<label class="control-label" for="name">Name:
			<input class="form-control" type="text" name="name" id="name" value="">
			</label>
		</div>
		<div class="form-group">
			<label class="control-label" for="description">Description:
			<input class="form-control" type="text" name="description" id="description" value="">
			</label>
		</div>
		<div class="form-group">
			<input class="btn btn-success btn-block" type="submit" value="Create Project">
		</div>
	</form>
<a class="btn btn-primary btn-block" href="..">Return to Manage Home</a>
<br>
<a class="btn btn-primary btn-block" href="../..">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
<script src="../../../js/jquery-2.1.3.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
</div>
</body>
</html>