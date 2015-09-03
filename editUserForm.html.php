<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Edit My Account</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container-fluid">
	<h1>Edit My Account</h1>
	<form action="?updateUser" method="post">
		<div class="form-group">
			<label class="control-label" for="name">First Name:</label>
			<input class="form-control"  type="text" name="firstName" id="firstName" value="<?php htmlout($_SESSION['firstName']); ?>">
		</div>
		<div class="form-group">
			<label class="control-label" for="email">Last Name:</label>
			<input class="form-control" type="text" name="lastName" id="lastName" value="<?php htmlout($_SESSION['lastName']); ?>">
		</div>
		<div class="form-group">
			<label class="control-label" for="email">Email:</label>
			<input class="form-control" type="text" name="email" id="email" value="<?php htmlout($_SESSION['email']); ?>">
		</div>
		<div class="form-group">
			<label class="control-label" for="email">Phone:</label>
			<input class="form-control" type="text" name="phone" id="phone" value="<?php htmlout($_SESSION['phone']); ?>">
		</div>
		<div class="form-group">
			<input type="hidden" name="id" value="<?php htmlout($_SESSION['id']); ?>">
			<input class="btn btn-success btn-block" type="submit" value="Update My Account">
		</div>
	</form>
<a class="btn btn-primary btn-block" href=".">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
<script src="../../js/jquery-2.1.3.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
</div>
</body>
</html>