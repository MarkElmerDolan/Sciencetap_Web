<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>View Data for Project</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
	<h3>View Data for Project: <?php htmlout($projectName); ?></h3>

			<div id="siteDisplay" class="well">
			</div>
			<form action="" method="post">
			<input type="hidden" name="projectName" value="<?php echo $projectName; ?>">
			<input type="submit" name="action" value="Download As CSV" class="btn btn-primary btn-block">
			<br>
			<br>
			<div id="dataDisplay" class="well">
			</div>
			</form>
			<div id="photoDisplay" class="well">
			</div>
<br>
<a class="btn btn-primary btn-block" href=".">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
<script src="../js/jquery-2.1.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</div>
</body>
<script>

		var sites= [];
		var data = [];
		var inputs = [];
		var forms = [];
		var users = [];
		var images = [];
		
		<?php foreach($sites as $site){ ?>
				sites.push(
				{
					'name' : "<?php echo $site['name']; ?>",
					'siteId' : "<?php echo $site['siteId']; ?>"
				}
				);
		<?php } ?>
		<?php foreach($data as $datum){ ?>
				data.push(
				{
					'value' : "<?php echo $datum['value']; ?>",
					'siteId' : "<?php echo $datum['siteId']; ?>",
					'lat' : "<?php echo $datum['lat']; ?>",
					'lon' : "<?php echo $datum['lon']; ?>",
					'time' : "<?php echo $datum['time']; ?>",
					'submittedBy' : "<?php echo $datum['submittedBy']; ?>",
					'inputId' : "<?php echo $datum['inputId']; ?>"
				}
				);
		<?php } ?>
		<?php foreach($inputs as $input){ ?>
				inputs.push(
				{
					'name' : "<?php echo $input['name']; ?>",
					'type' : "<?php echo $input['type']; ?>",
					'formId' : "<?php echo $input['formId']; ?>",
					'inputId' : "<?php echo $input['inputId']; ?>"
				}
				);
		<?php } ?>
		<?php foreach($forms as $form){ ?>
				forms.push(
				{
					'name' : "<?php echo $form['name']; ?>",
					'formId' : "<?php echo $form['formId']; ?>"
				}
				);
		<?php } ?>
		<?php foreach($users as $user){ ?>
				users.push(
				{
					'firstName' : "<?php echo $user['firstName']; ?>",
					'lastName' : "<?php echo $user['lastName']; ?>",
					'id' : "<?php echo $user['id']; ?>"
				}
				);
		<?php } ?>
		<?php foreach($images as $image){ ?>
				images.push(
				{
					'name' : "<?php echo $image['name']; ?>",
					'siteId' : "<?php echo $image['siteId']; ?>",
					'link' : "<?php echo $image['link']; ?>",
					'time' : "<?php echo $image['time']; ?>",
					'submittedBy' : "<?php echo $image['submittedBy']; ?>"
				}
				);
		<?php } ?>
		
		/*
		data.sort(function(a,b){
			return a.time.localeCompare(b.time);
		});
		*/

	 var displaySites = function(){
	
		var displaySiteString = "<select name='sites' id='sites' class='form-control'>";
		displaySiteString += "<option value='All'>Select A Site</option><option value='All'>All</option>";
		for(i = 0; i < sites.length; i++){
			displaySiteString += "<option value='" + sites[i].siteId + "'>" + sites[i].name + "</option>";
		}
		displaySiteString += "</select>";
		$('#siteDisplay').append(displaySiteString);
	 }
	var displayData = function(){
		var displayDataString = "<table class='table'>";
		displayDataString += "<thead><tr class='header'><th>Site</th><th>Form</th><th>Field</th><th>Value</th>";
		displayDataString += "<th>Lat</th><th>Lon</th><th>Time</th><th>Submitted By</th></tr></thead>";
		displayDataString += "<tbody>";
		for(i = 0; i < data.length; i++){
			displayDataString += "<tr>";
			var siteFound = false;
			for(j=0; j < sites.length; j++){
				if(data[i].siteId == sites[j].siteId && !siteFound){
					displayDataString += "<tr class=" + sites[j].siteId + "><td>" +
					'<input type="hidden" name="siteNames[]" value="' + sites[j].name + '">' + sites[j].name + "</td>";
					siteFound = true;
				}
			}
			if(!siteFound){
				displayDataString += "<tr><td>" + 
				'<input type="hidden" name="siteNames[]" value="None">None</td>';
			}
			var inputFound = false;
			for(j=0; j < inputs.length; j++){
				if(data[i].inputId == inputs[j].inputId && !inputFound){
					var formFound = false;
					for(k=0; k < forms.length; k++){
						if(inputs[j].formId == forms[k].formId && !formFound){
							displayDataString += "<td>" + forms[k].name + 
							'<input type="hidden" name="formNames[]" value="' + forms[k].name + '"></td>';
							formFound = true;
						}
					}
					displayDataString += "<td>" + inputs[j].name + 
					'<input type="hidden" name="inputNames[]" value="' + inputs[j].name + '"></td>';
					inputFound = true;
				}
			}
			displayDataString += "<td>" + '<input type="hidden" name="values[]" value="' + data[i].value +	'">' +
			data[i].value + "</td>";
			displayDataString += "<td>" + '<input type="hidden" name="lats[]" value="' + data[i].lat +	'">' +
			data[i].lat + "</td>";
			displayDataString += "<td>" + '<input type="hidden" name="lons[]" value="' + data[i].lon +	'">' +
			data[i].lon + "</td>";
			displayDataString += "<td>" + '<input type="hidden" name="times[]" value="' + data[i].time +	'">' +
			data[i].time + "</td>";
			for(j=0; j < users.length; j++){
				if(data[i].submittedBy == users[j].id){
					displayDataString += "<td>" + users[j].firstName + " " + users[j].lastName + 
					'<input type="hidden" name="names[]" value="' + users[j].firstName + " " + users[j].lastName +
					'">' +"</td>";
				}
			}
			displayDataString += "</tr>";
		}
		displayDataString += "</tbody></table>";
		$('#dataDisplay').append(displayDataString);
	 }
		
	 displaySites();
	 displayData();
	 
$(document).ready(function () {
   $("#sites").on("change", function(){
		if($(this).val() == 'Select A Site' || $(this).val() == 'All'){
			$('#dataDisplay').html('');
			displayData();
		}else{
			displaySiteData($(this).val());
		}
   });
});

var displaySiteData = function(index){
	$('tr').hide();
	$('thead').show();
	$("tr[class='header']").show();
	$("tr[class='" + index + "']").show();
 }
 
 var displayImages = function(){
	displayImageString ='';
	for(i=0; i < images.length; i++){
		displayImageString += '<div class="thumbnail">';
		displayImageString += '<img class="viewDataImage" src="' + images[i].link + '">';
		displayImageString += '<div class="caption"><h3>' + images[i].name + '</h3>';
		displayImageString += '<p>Site: ';
		var siteFound = false;
		for(j = 0; j < sites.length; j++){
			if(images[i].siteId == sites[j].siteId && !siteFound){
				displayImageString += sites[j].name + '</p>';
				siteFound = true;
			}
		}
		if(!siteFound){
			displayImageString += 'None</p>';
		}
		displayImageString += '<p>Time: ' + images[i].time + '</p>';
		displayImageString += '<p>Submitted by: ';
		var userFound = false;
		for(k=0; k < users.length; k++){
			if(images[i].submittedBy == users[k].id && !userFound){
				displayImageString += users[k].firstName + " " + users[k].lastName + '</p>';
				userFound = true;
			}
		}
		displayImageString += '</div>';
		displayImageString += '<form action="" method="post">';
		displayImageString += '<input type="hidden" name="imageSrc" value="' + images[i].link + '">';
		displayImageString += '<input type="hidden" name="imageUserName" value="' + images[i].name + '">';
		displayImageString += '<input type="submit" name="action" value="Download Image" class="btn btn-primary btn-block">';
		displayImageString += '</form></div>';
	}
	$('#photoDisplay').append(displayImageString);
 }

 displayImages();
 
</script>
</html>