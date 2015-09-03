<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create a Form</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="../../css/style.css" rel="stylesheet"/>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
<h3>Create a Form</h3>
<form action="?addForm" method="post">
	<div class="well">
		<div class="form-group" id="formNameDiv">
			<label>Form Name:</label>
			<input name="formName" id="formName" type="text" class="form-control" required> 
		</div>
		<div class="form-group" id="formDescDiv">
			<label>Form Description:</label>
			<input name="form_description" id="form_description" type="text" class="form-control"> 
		</div>
		<div id="dataFields">
			<div class="form-inline"> 
					<label>Data Field Name:</label>
					<input name="dataNames[]" id="dataName0" type="text" class="form-control" required> 
					<label for="dataTypes[]">Data Type:</label>
					<select name="dataTypes[]" id="dataType0" class="form-control datatypes" required> 
						<option value="Number">Number</option>
						<option value="Text">Text</option>
						<option value="CheckBox">CheckBox</option>
						<option value="Dropdown">Dropdown</option>
					</select>
					<div id="list0"></div>
			</div>
		</div>
		<br>
		<button class="btn btn-primary" type="button" onclick="addDataField()">Add Another Data Field</button>
	</div>
	<div>
		<input type="hidden" name="userId" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="size" id="size" value="1">
		<input id="createForm" class="btn btn-success btn-block" type="submit" value="Create Form">
	</div>
</form>
<div id="confirmMessage"></div>
<br>
<a class="btn btn-primary btn-block" href="..">Return to Manage Home</a>
<br>
<a class="btn btn-primary btn-block" href="../..">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
<script src="../../../js/jquery-2.1.3.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script>
	var numElements = 1;
	var listLenArr = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	var takenNames = [];
	var size = 1;
	
	<?php foreach($forms as $form){?> 
			takenNames.push("<?php echo $form['name']; ?>");
	<?php } ?>
	
	var addDataField = function(){
		var dataFieldElement = "<br><div class='form-inline'>" +
				"<label>Data Field Name:&nbsp;</label>" +
				"<input name='dataNames[]' id='dataName" + numElements + "' type='text' class='form-control' required>" +
				"<label for='dataTypes[]'>&nbsp;Data Type:&nbsp;</label>" +
				"<select name='dataTypes[]' id='dataType" + numElements + "' class='form-control datatypes' required>" +
					"<option value='Number'>Number</option>" +
					"<option value='Text'>Text</option>" +
					"<option value='CheckBox'>CheckBox</option>" +
					'<option value="Dropdown">Dropdown</option>' +
				"</select>" +
				'<div id="list' + numElements + '"></div>' +
				"</div>";
		$("#dataFields").append(dataFieldElement);
		setDropdownListener(numElements);
		numElements++;
		size++;
		$("#size").val(size);
	};
	
	
	var setDropdownListener = function(index){
			$('#dataType' + index).on("change", function(){
						if($(this).val() == 'Dropdown'){
							$('#list' + index).append(
								"<br/>"+
								'<input type="text" name="list' + index + '[]" id="val' + listLenArr[index] + '" class="form-control" required>' +
								'<button type="button" class="btn btn-primary btn-xs" onclick="addListVal(' + index + ')">Add Another Dropdown Value</button>'+
								'<button type="button" class="btn btn-warning btn-xs" onclick="removeListVal(' + index + ')">Remove Last Dropdown Value</button>'
							);
						}else{
							$('#list' + index).html('');
						}
			});
	};
	
	setDropdownListener(0);
	
	var addListVal = function(index){
		listLenArr[index]++;
		var listElement = '<br><input type="text" name="list' + index + '[]" id="list' + index + 'Val' + listLenArr[index] + '" class="form-control" required>';
		$('#list' +index).append(listElement);
	}
	
	var removeListVal = function(index){
		$('#list' + index + 'Val' + listLenArr[index]).prev().remove();
		$('#list' + index + 'Val' + listLenArr[index]).remove()
		listLenArr[index]--;
	};
$(document).ready(function () {
   $("#formName").keyup(checkTakenNames);
});

function checkTakenNames() {
    var newName = $("#formName").val();
	var submittable = true;
	for(i = 0; i < takenNames.length; i++){
		if(newName == ''){
			$("#confirmMessage").html("Form name can not be blank.");
			$("#createForm").attr("disabled", "disabled");
			submittable = false;
		}else if(newName == takenNames[i]){
			$("#confirmMessage").html("Form name is taken.");
			$("#createForm").attr("disabled", "disabled");
			submittable = false;
		}
	}
	if(submittable){
		$("#confirmMessage").html('');
		$("#createForm").removeAttr("disabled");
	}
}
</script>
</div>
</body>
</html>