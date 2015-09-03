<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Assign or Remove Users From Projects</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
<div class="row">
	<h3>Assign or Remove Users From Projects</h3>
		<div id="display" class="well">
		</div>
<br>
<a class="btn btn-primary btn-block" href="..">Return to Manage Home</a>
<br>
<a class="btn btn-primary btn-block" href="../..">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
</div>
<script src="../../../js/jquery-2.1.3.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script>
	var users= [];
	var projects= [];
	var projectUsers= [];
	
	<?php foreach($users as $user){?> 
			users.push(
			{
				'firstName' : "<?php echo $user['firstName']; ?>",
				'lastName' : "<?php echo $user['lastName']; ?>",
				'id' : "<?php echo $user['id']; ?>",
				'email' : "<?php echo $user['email']; ?>",
				'phone' : "<?php echo $user['phone']; ?>",
				'super_admin' : "<?php echo $user['super_admin']; ?>"
			}
			);
	<?php } ?>
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
	
	
	var displayData = function(){
		var displayDataString = '';
		for(i = 0; i < users.length; i++){
			displayDataString += '<dl>';
			displayDataString += '<form action="" method="post">';
			displayDataString += '<dt><strong>' + users[i].firstName + ' ' + users[i].lastName + '  </strong>';
			displayDataString += '<input type="hidden" name="id" value="' + users[i].id + '">';
			displayDataString += '<input type="hidden" name="firstName" value="' + users[i].firstName + '">';
			displayDataString += '<input type="hidden" name="lastName" value="' + users[i].lastName + '">';
			displayDataString += '<input type="hidden" name="email" value="' + users[i].email + '">';
			displayDataString += '<input type="hidden" name="super_admin" value="' + users[i].super_admin + '">';
			displayDataString += '<input name="action" class="btn btn-primary btn-xs" type="submit" value="Assign User To Project">';
			<?php if(isset($_SESSION['superAdmin'])){ ?>
				displayDataString += '  <input name="action" class="btn btn-warning btn-xs" type="submit" 	value="Assign User Roles">';
			<?php } ?>

			displayDataString += '</dt></form>';
			displayDataString += '<dd>Email: ' + users[i].email + '</dd>';
			displayDataString += '<dd>Phone: ' + users[i].phone + '</dd>';
			if(users[i].super_admin == 1){
				displayDataString += '<dd>Role: Super Admin</dd>';
			}
			displayDataString += '<dd>Projects: </dd>';
			displayDataString += '<ul>';
			var count = 0;
			for(j = 0; j < projectUsers.length; j++){
				if(users[i].id == projectUsers[j].userId){
					count++;
					for(k = 0; k < projects.length; k++){
						if(projectUsers[j].projectId == projects[k].id){
							displayDataString += '<li>Project: ' + projects[k].name + '</li>';
						}
						if(projectUsers[j].project_admin == 1){
							displayDataString += '<li>Role: Project Admin:</li>';
						}
					}
				}
			}
			if(count == 0){
				displayDataString += '<li>None</li>';
			}
			displayDataString += '</ul>';
			displayDataString += '</dl>';
		}
		$('#display').append(displayDataString);
	}
	displayData();	
	
</script>
</div>
</body>
</html>