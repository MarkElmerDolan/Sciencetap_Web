<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>View Projects And Sites</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
	<h3>View Projects And Sites</h3>
		<div id="display" class="well">
		</div>
<br>
<a class="btn btn-primary btn-block" href="..">Return to Manage Home</a>
<br>
<a class="btn btn-primary btn-block" href="../..">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
<script src="../../../js/jquery-2.1.3.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script>
	var projects= [];
	var sites= [];
	
	<?php foreach($projects as $project){?> 
			projects.push(
			{
				'name' : "<?php echo $project['project_name']; ?>",
				'id' : "<?php echo $project['project_id']; ?>",
				'description' : "<?php echo $project['project_description']; ?>",
				'dateCreated' : "<?php echo $project['time_created']; ?>"
			}
			);
	<?php } ?>
	<?php foreach($sites as $site){?> 
			sites.push(
			{
				'name' : "<?php echo $site['site_name']; ?>",
				'siteId' : "<?php echo $site['site_id']; ?>",
				'projectId' : "<?php echo $site['project_id']; ?>",
				'description' : "<?php echo $site['site_description']; ?>",
				'lat' : "<?php echo $site['site_lat']; ?>",
				'lon' : "<?php echo $site['site_lon']; ?>"
			}
			);
	<?php } ?>
		
	var displayData = function(){
	 
		var displayDataString = '';
		for(i = 0; i < projects.length; i++){
			displayDataString += '<dl>';
			displayDataString += '<form action="" method="post">';
			displayDataString += '<dt><strong>' + projects[i].name + '  </strong>';
			displayDataString += '<input type="hidden" name="id" value="' + projects[i].id + '">';
			displayDataString += '<input type="hidden" name="name" value="' + projects[i].name + '">';
			displayDataString += '<input type="hidden" name="description" value="' + projects[i].description + '">';
			displayDataString += '<input name="action" class="btn btn-primary btn-xs" type="submit" value="Edit Project Details">';
			displayDataString += '</dt></form>';
			displayDataString += '<dd>Description: ' + projects[i].description + '</dd>';
			displayDataString += '<dd>Date Created: ' + projects[i].dateCreated + '</dd>';
			for(j = 0; j < sites.length; j++){
				if(sites[j].projectId == projects[i].id){
					displayDataString += '<ul>';
					displayDataString += '<form action="" method="post">';					
					displayDataString += '<li>Site Name: ' + sites[j].name;
					displayDataString += '<input type="hidden" name="name" value="' + sites[j].name + '">';
					displayDataString += '<input type="hidden" name="description" value="' + sites[j].description + '">';
					displayDataString += '<input type="hidden" name="lat" value="' + sites[j].lat + '">';
					displayDataString += '<input type="hidden" name="lon" value="' + sites[j].lon + '">';
					displayDataString += '<input type="hidden" name="id" value="' + sites[j].siteId + '">';
					displayDataString += '  <input name="action" class="btn btn-info btn-xs" type="submit" value="Edit Site Details"></li></form>';
					displayDataString += '<li>Description: ' + sites[j].description + '</li>';
					displayDataString += '<li>Latitude: ' + sites[j].lat + '</li>';
					displayDataString += '<li>Longitude: ' + sites[j].lon + '</li>';
					displayDataString += '</ul>';
				}
			}
			displayDataString += '</dl>';
		}

		$('#display').append(displayDataString);
	}
	displayData();	
	
</script>
</div>
</body>
</html>