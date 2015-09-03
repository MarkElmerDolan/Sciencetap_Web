<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Update User Projects</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
<div clas="row">
	<h3>Update User Projects for: <?php echo $firstName; ?> <?php echo $lastName; ?></h3>
	<form action="?assignUser" method="post">
		<div id="assignProjectDisplay" class="well">
		</div>
		<div id="removeProjectDisplay" class="well">
		</div>
		<div>
			<input type="hidden" name="id" value="<?php echo $userId; ?>">
			<input class="btn btn-success btn-block" type="submit" value="Update User Projects">
		</div>
		<br>
	</form>
<a class="btn btn-primary btn-block" href="..">Return to Manage Home</a>
<br>
<a class="btn btn-primary btn-block" href="../..">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
</div>
<script src="../../../js/jquery-2.1.3.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script>
	var projects= [];
	var projectUsers= [];
	var userId = <?php echo $userId; ?>;
	console.log(userId);
	
	<?php foreach($projects as $project){?> 
			projects.push(
			{
				'name' : "<?php echo $project['project_name']; ?>",
				'id' : "<?php echo $project['project_id']; ?>"
			}
			);
	<?php } ?>
	<?php foreach($projectUsers as $projectUser){?> 
			projectUsers.push(
			{
				'userId' : "<?php echo $projectUser['userId']; ?>",
				'projectId' : "<?php echo $projectUser['projectId']; ?>"
			}
			);
	<?php } ?>
		
	var displayAssignProjects = function(){
		var displayProjectString = '<fieldset><legend>Assign to Project:</legend>';
		for(i = 0; i < projects.length; i++){
			var assigned = false;
			for(j = 0; j < projectUsers.length; j++){
				if(projectUsers[j].userId == userId && projectUsers[j].projectId == projects[i].id){
					assigned = true;
				}
			}
			if(!assigned){
				displayProjectString += '<div class="checkbox"><label>';
				displayProjectString += '<input type="checkbox" name="assignProjects[]" id="' + projects[i].id +
					'" value="' + projects[i].id + '">';
				displayProjectString += projects[i].name + '</label></div>';
			}
		}
		displayProjectString += '</fieldset>';
		$('#assignProjectDisplay').append(displayProjectString);
	}
	displayAssignProjects();
	
	var displayRemoveProjects = function(){
		var displayProjectString = '<fieldset><legend>Remove From Project:</legend>';
		for(i = 0; i < projects.length; i++){
			for(j = 0; j < projectUsers.length; j++){
				if(projectUsers[j].userId == userId && projectUsers[j].projectId == projects[i].id){
					displayProjectString += '<div class="checkbox"><label>';
					displayProjectString += '<input type="checkbox" name="removeProjects[]" id="' + projects[i].id +
						'" value="' + projects[i].id + '">';
					displayProjectString += projects[i].name + '</label></div>';
				}
			}
		}
		displayProjectString += '</fieldset>';
		$('#removeProjectDisplay').append(displayProjectString);
	}
	displayRemoveProjects();
	
</script>
</div>
</body>
</html>