<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Upload Data to Project</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
	<h3>Upload Data to Project: <?php htmlout($projectName); ?></h3>
	<form action="?uploadData" method="post" enctype="multipart/form-data">
		<fieldset>
			<div id="siteDisplay" class="well">
			</div>
			<legend><?php htmlout($projectName); ?> Forms:</legend>
			<div id="formDisplay" class="well">
			</div>
			<div id="inputsDisplay" class="well">
			</div>	
		</fieldset>
		<div id="imageInputs" class="well">
			<div class="form-group">
			<label for="image0">Select an image to upload:</label>
				<input type="file" id="image0" name="image0">
			</div>
			<div class="form-group">
				<label class="control-label" for="imageName0">Image Name</label>
				<input class="form-control" type="text" id="imageName0" name="imageName0">
			</div>
		</div>
		<button class="btn btn-info btn-block" type="button" onclick="addImageField()">Add Another Image</button>
		<br>
		<div>
			<input type="hidden" name="userId" value="<?php htmlout($_SESSION['id']); ?>">
			<input type="hidden" name="projectId" value="<?php echo $projectId; ?>">
			<input class="btn btn-success btn-block" type="submit" value="Upload Data">
		</div>
	</form>
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
		var forms = [];
		var inputs = [];
		var dropdowns = [];
		var numImages = 1;
		
		<?php foreach($sites as $site){?> 
				sites.push(
				{
					'name' : "<?php echo $site['site_name']; ?>",
					'siteId' : "<?php echo $site['site_id']; ?>"
				}
				);
		<?php } ?>	
		<?php foreach($forms as $form){ ?>
				forms.push(
				{
					'name' : "<?php echo $form['form_name']; ?>",
					'formId' : "<?php echo $form['form_id']; ?>"
				}
				);
		<?php } ?>
		<?php foreach($inputs as $input){ ?>
				inputs.push(
				{
					'name' : "<?php echo $input['form_input_name']; ?>",
					'type' : "<?php echo $input['form_input_type']; ?>",
					'formId' : "<?php echo $input['form_id']; ?>",
					'inputId' : "<?php echo $input['form_input_id']; ?>"
				}
				);
				<?php }?>
				
		<?php foreach($dropdowns as $dropdown){ ?>
				dropdowns.push(
				{
					'value' : "<?php echo $dropdown['dropdown_value']; ?>",
					'inputId' : "<?php echo $dropdown['form_input_id']; ?>"
				}
				);
				<?php }?>

	 var displaySites = function(){
	 
		var displaySiteString = "<select name='sites' id='sites' class='form-control'>";
		displaySiteString += "<option value=''>Select A Site</option>";
		for(i = 0; i < sites.length; i++){
			displaySiteString += "<option value='" + sites[i].siteId + "'>" + sites[i].name + "</option>";
		}
		displaySiteString += "</select>";
		$('#siteDisplay').append(displaySiteString);
	 }
		
	 var displayForms = function(){
	 
		var displayFormString = "<select name='forms' id='forms' class='form-control'>";
		displayFormString += "<option value=''>Select A Form</option>";
		for(i = 0; i < forms.length; i++){
			displayFormString += "<option value='" + forms[i].formId + "'>" + forms[i].name + "</option>";
		}
		displayFormString += "</select>";
		$('#formDisplay').append(displayFormString);
	 }
	 
 displaySites();
displayForms();

	$('#forms').on("change", function(){
		$('#inputsDisplay').empty();
		
		for(i = 0; i < inputs.length; i++){
			console.log($(this).val());
			console.log(inputs[i].formId);
			if($(this).val() == inputs[i].formId){
				if(inputs[i].type == 'Dropdown'){
					var displayString = '<div class="form-group"'+
					'<label class="control-label" for"' + inputs[i].name + '"> ' + inputs[i].name + '</label>  ' +
					'<select class="form-control" name="' + inputs[i].inputId + '">';
					for(j = 0; j < dropdowns.length; j++){
						if(dropdowns[j].inputId == inputs[i].inputId){
							displayString += '<option>' + dropdowns[j].value + '</option>';
						}
					}
					displayString +='</select></div>';
					$('#inputsDisplay').append(displayString);
				}else{
					$('#inputsDisplay').append(
					'<div class="form-group">'+
					'<label class="control-label" for"' + inputs[i].name + '"> ' + inputs[i].name + '</label>  ' +
					'<input class="form-control" type="' + inputs[i].type + '" id="' + i + '" name="' + inputs[i].inputId + '">'+
					'</div>'
					);
				}
			}
		}
		
		$('#inputsDisplay').append(
			'<div class="form-group">'+
			'<label class="control-label" for"lat">Latitude:</label> ' +
			'<input class="form-control" type="Number" id="lat" name="lat" step="0.0001" required>'+
			'</div>' +
			'<div class="form-group">'+
			'<label class="control-label" for"lon">Longitude:</label> ' +
			'<input class="form-control" type="Number" id="lon" name="lon" step="0.0001" required>'+
			'</div>'
		);
	});
	var addImageField = function(){
		var imageElement = '<div class="form-group">' + 
			'<label for="image' + numImages + '">Select an image to upload:</label>' +
			'<input type="file" id="image' + numImages + '" name="image' + numImages + '"></div>' +
			'<div class="form-group">' +
			'<label class="control-label" for="imageName' + numImages + '">Image Name</label>' +
			'<input class="form-control" type="text" id="imageName' + numImages +
			'" name="imageName' + numImages + '"></div>';
			$("#imageInputs").append(imageElement);
			numImages++;
	}
	 
</script>
</html>