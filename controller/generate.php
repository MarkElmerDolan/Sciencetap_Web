<?php
	$srcurl = 'http://localhost/st/controller/controller.php';
	$tempfilename = $_SERVER['DOCUMENT_ROOT'] . '/st/controller/tempindex.html';
	$targetfilename = $_SERVER['DOCUMENT_ROOT'] . '/st/controller/index.html';
	
	if(file_exists($tempfilename)){
		unlink($tempfilename);
	}
	
	$html = file_get_contents($srcurl);
	if(!$html){
		$error = "Unable to load $srcurl. Static page update aborted";
		include 'error.html.php';
		exit();
	}
	
	if(!file_put_contents($tempfilename, $html)){
		$error = "Unable to write $tempfilename.";
		include 'error.html.php';
		exit();
	}
	
	copy($tempfilename, $targetfilename);
	unlink($tempfilename);

?>