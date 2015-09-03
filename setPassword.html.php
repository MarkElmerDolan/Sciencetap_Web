<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Set Password</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container-fluid">
	<h1>Set Your Password</h1>
	<form action="?setPasswordForm" method="post">
		<div class="form-group">
			<label class="control-label" for="password">Set password:</label>
			<input class="form-control" type="password" name="password" id="password">
		</div>
		<div class="form-group">
			<label class="control-label" for="password">Confirm password:</label>
			<input class="form-control" type="password" name="confirm" id="confirm">
		</div>
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
			<input id="setPassword" class="btn btn-success btn-block" type="submit" value="Set Password">
		</div>
	</form>
	<div id="confirmMessage">
	
	</div>
	
	<p><?php
		if(isset($error)){
			echo $error;
		}
		?>
	</p>
<a class="btn btn-primary btn-block" href=".">Return to Home</a>
<br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
<script src="../js/jquery-2.1.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
   $("#confirm").keyup(checkPasswordMatch);
});

function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#confirm").val();

	if(password == ''){
		$("#confirmMessage").html("Password can not be blank.");
	}else if (password != confirmPassword){
        $("#confirmMessage").html("Passwords do not match!");
		$("#setPassword").attr("disabled", "disabled");
	}else{
        $("#confirmMessage").html("Passwords match.");
		$("#setPassword").removeAttr("disabled");
	}
}
</script>
</div>
</body>
</html>