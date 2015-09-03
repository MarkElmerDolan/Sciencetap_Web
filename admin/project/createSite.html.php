<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create a Site</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
	<h3>Create a Site</h3>
	<form action="?createSite" method="post">
		<div class="form-group">
			<label class="control-label" for="name">Site Name:</label>
			<input class="form-control" type="text" name="name" id="name" value="">
		</div>
		<div class="form-group">
			<label class="control-label" for="description">Description:</label>
			<input class="form-control" type="text" name="description" id="description" value="">
		</div>
		<div class="form-group">
			<label class="control-label" for="lat">Latitude:</label>
			<input class="form-control" type="number" name="lat" id="lat" value="" step="0.0001">
		</div>
		<div class="form-group">
			<label class="control-label" for="lon">Longitude:</label>
			<input class="form-control" type="number" name="lon" id="lon" value="" step="0.0001">
		</div>
		<fieldset>
			<legend>Assign to Project:</legend>
			<?php foreach ($projects as $project): ?>
			<div class="radio">
				<label>
					<input type="radio" name="projects" id="<?php htmlout($project['project_id']); ?>"
					value="<?php htmlout($project['project_id']); ?>">
					<?php htmlout($project['project_name']); ?>
				</label>
			</div>
			<?php endforeach; ?>
		</fieldset>
		<div>
			<input class="btn btn-success btn-block" type="submit" value="Create Site">
		</div>
		<br>
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