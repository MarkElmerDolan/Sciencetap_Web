<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Update Form Projects</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
	<h3>Update Form Projects for: <?php echo $formName; ?></h3>
	<form action="?assignForm" method="post">
		<div id="assignProjectDisplay" class="well">
		</div>
		<div id="removeProjectDisplay" class="well">
		</div>
		<div>
			<input type="hidden" name="id" value="<?php echo $formId; ?>">
			<input class="btn btn-success btn-block" type="submit" value="Update Form Projects">
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
<script>
	var projects = [];
	var projectForms = [];
	var formId = <?php echo $formId; ?>;
	
	<?php foreach($projects as $project){?> 
			projects.push(
			{
				'name' : "<?php echo $project['project_name']; ?>",
				'id' : "<?php echo $project['project_id']; ?>"
			}
			);
	<?php } ?>
	<?php foreach($projectForms as $projectForm){?> 
			projectForms.push(
			{
				'formId' : "<?php echo $projectForm['form_id']; ?>",
				'projectId' : "<?php echo $projectForm['project_id']; ?>"
			}
			);
	<?php } ?>
		
	var displayAssignProjects = function(){
		var displayProjectString = '<fieldset><legend>Assign to Project:</legend>';
		for(i = 0; i < projects.length; i++){
			var assigned = false;
			for(j = 0; j < projectForms.length; j++){
				if(projectForms[j].formId == formId && projectForms[j].projectId == projects[i].id){
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
			for(j = 0; j < projectForms.length; j++){
				if(projectForms[j].formId == formId && projectForms[j].projectId == projects[i].id){
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