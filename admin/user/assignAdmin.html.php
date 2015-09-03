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
<div class="row">
	<h3>Update User Projects for: <?php echo $firstName; ?> <?php echo $lastName; ?></h3>
	<form action="?assignAdmin" method="post">
		<div id="assignProjectAdminDisplay" class="well">
		</div>
		<div id="removeProjectAdminDisplay" class="well">
		</div>
		<div id="makeSuperAdminDisplay" class="well">
		</div>
		<div id="removeSuperAdminDisplay" class="well">
		</div>
		<div>
			<input type="hidden" name="id" value="<?php echo $userId; ?>">
			<input class="btn btn-success btn-block" type="submit" value="Update User Roles">
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
	var projects = [];
	var projectUsers = [];
	var userId = <?php echo $userId; ?>;
	var super_admin = <?php echo $super_admin; ?>
	
	
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
				'projectId' : "<?php echo $projectUser['projectId']; ?>",
				'project_admin' : "<?php echo $projectUser['project_admin']; ?>"
			}
			);
	<?php } ?>
		
	var displayAssignProjectAdmin = function(){
		var displayString = '<fieldset><legend>Assign As Project Admin To Projects:</legend>';
		for(i = 0; i < projects.length; i++){
			var assigned = false;
			for(j = 0; j < projectUsers.length; j++){
				if(projectUsers[j].userId == userId && projectUsers[j].project_admin == "1" && projectUsers[j].projectId == projects[i].id){
					assigned = true;
				}
				
			}
			if(!assigned){
				displayString += '<div class="checkbox"><label>';
				displayString += '<input type="checkbox" name="assignProjects[]" id="' + projects[i].id +
					'" value="' + projects[i].id + '">';
				displayString += projects[i].name + '</label></div>';
			}
		}
		displayString += '</fieldset>';
		$('#assignProjectAdminDisplay').append(displayString);
	}
	displayAssignProjectAdmin();
	
	var displayRemoveProjectAdmin = function(){
		var displayString = '<fieldset><legend>Remove Project Admin From Projects:</legend>';
		for(i = 0; i < projects.length; i++){
			for(j = 0; j < projectUsers.length; j++){
				if(projectUsers[j].userId == userId && projectUsers[j].project_admin == "1" && projectUsers[j].projectId == projects[i].id){
					displayString += '<div class="checkbox"><label>';
					displayString += '<input type="checkbox" name="removeProjects[]" id="' + projects[i].id +
						'" value="' + projects[i].id + '">';
					displayString += projects[i].name + '</label></div>';
				}
				console.log(projectUsers[j].project_admin);
			}
		}
		displayString += '</fieldset>';
		$('#removeProjectAdminDisplay').append(displayString);
	}
	displayRemoveProjectAdmin();
	
	var displaySuperAdmin = function(){
		var assigned = false;
		if(super_admin == 1){
			var displayString = '<fieldset><legend>Remove Super Admin:</legend>';
			displayString += '<div class="checkbox"><label>';
			displayString += '<input type="checkbox" name="removeSuperAdmin" id="' + userId +
				'" value="' + userId + '">';
			displayString += '</label></div>';
			displayString += '</fieldset>';
			$('#removeSuperAdminDisplay').append(displayString);
			assigned = true;
		}
		if(!assigned){
			var displayString = '<fieldset><legend>Make Super Admin:</legend>';
			displayString += '<div class="checkbox"><label>';
			displayString += '<input type="checkbox" name="makeSuperAdmin" id="' + userId +
				'" value="' + userId + '">';
			displayString += '</label></div>';
			displayString += '</fieldset>';
			$('#makeSuperAdminDisplay').append(displayString);
		}
	}
	displaySuperAdmin();
	
</script>
</div>
</body>
</html>