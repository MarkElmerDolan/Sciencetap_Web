<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create A User</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
<div class="row">
	<h3>Create A User</h3>
	<form action="?addUser" method="post">
		<div class="form-group">
			<label class="control-label" for="firstName">First Name:
			<input class="form-control" type="text" name="firstName" id="firstName" value="">
			</label>
		</div>
		<div class="form-group">
			<label class="control-label" for="lastName">Last Name:
			<input class="form-control" type="text" name="lastName" id="lastName" value="">
			</label>
		</div>
		<div class="form-group">
			<label class="control-label" for="email">Email:
			<input class="form-control" type="email" name="email" id="email" value="" required>
			</label>
		</div>
		<div class="form-group">
			<label class="control-label" for="phone">Phone:
			<input class="form-control" type="text" name="phone" id="phone" value="">
			</label>
		</div>
		<div class="form-group">
			<input class="btn btn-success btn-block" type="submit" value="Create User">
		</div>
	</form>
<a class="btn btn-primary btn-block" href="..">Return to Manage Home</a>
<br>
<a class="btn btn-primary btn-block" href="../..">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
</div>
<script src="../../../js/jquery-2.1.3.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
</div>
</body>
</html>