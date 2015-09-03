<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Assign Form to Categories</title>
</head>
<body class="hasHeader">
<div class="container-fluid">
<?php include 'navbar.html.php';?>
	<h3>Assign Form to Categories</h3>
	<h3><?php htmlout($formName); ?></h3>
	<form action="?assignCategory" method="post">
		<fieldset>
			<legend>Categories:</legend>
			<?php
				$assigned = false;
				if(isset($assignedCats)){
					foreach($categories as $category){
						foreach($assignedCats as $assignedCategory){
							if($assignedCategory['name'] == $category['name']){
								$assigned = true;
							}
						}
						if(!$assigned){
							echo '<div><label for="category' . $category['id'] . '">' .
								'<input type="checkbox" name="categories[]" id="category' . $category['id'] . '"' .
								'value="' . $category['id'] . '">' .
								htmlout($category['name']) . '</label>' . 
							'</div>';
						}
						$assigned = false;
					}
				}else{
					foreach($categories as $category){
						echo '<div><label for="category' . $category['id'] . '">' .
							'<input type="checkbox" name="categories[]" id="category' . $category['id'] . '"' .
							'value="' . $category['id'] . '">' .
							htmlout($category['name']) . '</label>' . 
						'</div>';
					}
				}
			?>
		</fieldset>
		<div>
			<input type="hidden" name="id" value="<?php htmlout($id); ?>">
			<input type="submit" value="<?php htmlout($button); ?>">
		</div>
	</form>
	<?php 
		if(isset($assignedCats)){
			echo "<h3>This form is assigned to the following categories</h3>";
			foreach($assignedCats as $assignedCategory){
				echo "<li>" . $assignedCategory['name'] . "</li>";
			}
		}
	?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php';?>
<p><a href="..">Return to Manage Home</a></p>
</div>
</body>
</html>