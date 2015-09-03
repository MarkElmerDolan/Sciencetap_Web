<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Controller Display</title>
	<link rel="canonical" href="/controller/">
</head>
<body>
<p>Here are the projects</p>

<ul>
	<?php foreach($projects as $project):?>
		<li><?php htmlout($project['name']); ?></li>
	<?php endforeach; ?>
</ul>
	<?php
		print_r($_SESSION);
	?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
<p><a href="..">Return to Home</a></p>
</body>
</html>