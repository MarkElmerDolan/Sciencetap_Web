<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Assign Site To Project</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
	<h3>Assign Site To Project</h3>
	<form action="?assignSite" method="post">
		<div id="siteDisplay" class="well">
		</div>
		<div id="projectDisplay" class="well">
		</div>
		<div>
			<input class="btn btn-success btn-block" type="submit" value="Assign Site To Project">
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
	var projects= [];
	var sites= [];
	
	<?php foreach($projects as $project){?> 
			projects.push(
			{
				'name' : "<?php echo $project['project_name']; ?>",
				'id' : "<?php echo $project['project_id']; ?>"
			}
			);
	<?php } ?>
	<?php foreach($sites as $site){?> 
			sites.push(
			{
				'name' : "<?php echo $site['site_name']; ?>",
				'siteId' : "<?php echo $site['site_id']; ?>",
				'projectId' : "<?php echo $site['project_id']; ?>"
			}
			);
	<?php } ?>
		
	var displaySites = function(){
	 
		var displaySiteString = "<select name='sites' id='sites' class='form-control'>";
		displaySiteString += "<option value=''>Select A Site</option>";
		for(i = 0; i < sites.length; i++){
			displaySiteString += "<option value='" + sites[i].siteId + "'>" + sites[i].name + "</option>";
		}
		displaySiteString += "</select>";
		$('#siteDisplay').append(displaySiteString);
	}
	displaySites();
	
	var displayProjects = function(){
		var displayProjectString = '<fieldset><legend>Assign to Project:</legend>';

		for(i = 0; i < projects.length; i++){
			displayProjectString += '<div class="radio"><label>';
			displayProjectString += '<input type="radio" name="projects" id="' + projects[i].id +
				'" value="' + projects[i].id + '">';
			displayProjectString += projects[i].name + '</label></div>';
		}
		displayProjectString += '</fieldset>';
		$('#projectDisplay').append(displayProjectString);
	}
	
	$('#sites').on("change", function(){
		$('#projectDisplay').html('');
		for(i = 0; i < sites.length; i++){
			if($(this).val() == sites[i].siteId){
				if(sites[i].projectId == 0){
					displayProjects();
				}else{
					for(j = 0; j < projects.length; j++){
						if(projects[j].id == sites[i].projectId){
							$('#projectDisplay').append('<h3>This site is already assign to project: ' +
							projects[j].name + '</h3>');
						}
					}
				}
			}
		}
	});
	
</script>
</div>
</body>
</html>