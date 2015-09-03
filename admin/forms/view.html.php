<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>View And Assign Forms To Project</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
	<h3>View And Assign Forms To Project</h3>
		<div id="display">
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
	var forms = [];
	var formInputs = [];
	var dropdowns = [];
	var projectForms = [];
	var projects= [];
	
	<?php foreach($forms as $form){?> 
			forms.push(
			{
				'id' : "<?php echo $form['formId']; ?>",
				'name' : "<?php echo $form['name']; ?>"
			}
			);
	<?php } ?>
	<?php foreach($formInputs as $formInput){?> 
			formInputs.push(
			{
				'id' : "<?php echo $formInput['form_input_id']; ?>",
				'inputName' : "<?php echo $formInput['form_input_name']; ?>",
				'inputType' : "<?php echo $formInput['form_input_type']; ?>",
				'formId' : "<?php echo $formInput['form_id']; ?>"
			}
			);
	<?php } ?>
	<?php foreach($dropdowns as $dropdown){?> 
			dropdowns.push(
			{
				'inputId' : "<?php echo $dropdown['form_input_id']; ?>",
				'value' : "<?php echo $dropdown['dropdown_value']; ?>"
			}
			);
	<?php } ?>
	<?php foreach($projectForms as $projectForm){?> 
			projectForms.push(
			{
				'project_id' : "<?php echo $projectForm['project_id']; ?>",
				'form_id' : "<?php echo $projectForm['form_id']; ?>"
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
	
	
	var displayData = function(){
		var displayDataString = '';
		for(i = 0; i < forms.length; i++){
			displayDataString += '<dl class="well">';
			displayDataString += '<form action="" method="post">';
			displayDataString += '<dt><strong>' + forms[i].name + '</strong>';
			displayDataString += '<input type="hidden" name="id" value="' + forms[i].id + '">';
			displayDataString += '<input type="hidden" name="formName" value="' + forms[i].name + '">';
			displayDataString += '  <input name="action" class="btn btn-primary btn-xs" type="submit" value="Assign Form To Project">';
			displayDataString += '</dt></form>';
			displayDataString += '<dd>Form Inputs: </dd>';
			displayDataString += '<ul>';
			var count = 0;
			for(j = 0; j < formInputs.length; j++){
				if(forms[i].id == formInputs[j].formId){
					count++;
					displayDataString += '<li>' + formInputs[j].inputName + '  ';
					displayDataString += ' - Input Type: ' + formInputs[j].inputType + '</li>';
					if(formInputs[j].inputType == 'Dropdown'){
						displayDataString += '<ul>'
						for(k = 0; k < dropdowns.length; k++){
							if(dropdowns[k].inputId == formInputs[j].id){
								displayDataString += '<li>' + dropdowns[k].value + '</li>';
							}
						}
						displayDataString += '</ul>'
					}
				}
			}
			if(count == 0){
				displayDataString += '<li>None</li>';
			}
			displayDataString += '</ul>';
			count = 0;
			displayDataString += '<dd>Projects: </dd>';
			displayDataString += '<ul>';
			for(j = 0; j < projects.length; j++){
				for(k = 0; k < projectForms.length; k++){
					if(projectForms[k].project_Id == projects[j].id  && projectForms[k].form_id == forms[i].id){
						displayDataString += '<li>' + projects[j].name + '</li>';
						count++;
					}
				}
			}
			if(count == 0){
				displayDataString += '<li>None</li>';
			}
			displayDataString += '</ul>';
			displayDataString += '</dl>';
			count = 0;
		}
		$('#display').append(displayDataString);
	}
	displayData();	
	
</script>
</div>
</body>
</html>