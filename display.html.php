<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
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
	<title>Manage Sciencetap</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container">
<div class="row">
<h1>Welcome to Sciencetap <?php echo $_SESSION['firstName'];?>!</h1>
<h3>My Projects</h3>

	<?php if($projects[0]['project_id'] != 0){
			echo '<table class="table table-hover"><thead><th>Project Name</th><th>Actions</th><th></th></thead><tbody>';
			foreach($projects as $project){
			echo '<form action="" method="post"><tr><td><strong>' . $project['project_name'] . '</strong></td>' .
				'<td><input type="hidden" name="projectId" value="' . $project['project_id'] . '">' .
				'<input type="hidden" name="projectName" value="' . $project['project_name'] . '">' .
				'<input type="submit" name="action" value="Upload Data" class="btn btn-success"></td>' .
				'<td><input type="submit" name="action" value="View Data" class="btn btn-success"></td></tr></form>';
			}
			echo '</tbody></table>';
		}else{
			echo '<h4 class="bg-warning">' . $projects[0]['project_description'] . '</h4>';
		}?>

<?php if(isset($_SESSION['superAdmin']) || isset($_SESSION['projectAdmin'])){
	echo '<a class="btn btn-primary btn-block" href="admin/">Admin Functions</a><br>';
}
?>
<form action="" method="post">
	<input type="submit" name="action" class="btn btn-primary btn-block" value="My Account">
</form>
<br>
<?php if(isset($warning)){ echo '<h3>' . $warning. '</h3>';} ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
</div>
<script src="../js/jquery-2.1.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</div>
</body>
</html>
