<!DOCTYPE html>
<html>
	<head>
		<style>
			#images {
				background-color: transparent;
        	  		column-count: 5;
				width: fit-content;
				height: fit-content;
        		}
			#image {
				display: block;
			}
		</style>
		<title>Image Gallery</title>
		<h1>Image Gallery (<a href="/upload_image">Upload an image</a>)</h1>
		<hr>
	</head>
	<body>
		<div id="images">
<?php
	if ( file_get_contents("maintenanceStatus.txt") == "true" && $_SERVER['REMOTE_ADDR'] != "127.0.0.1" ) {
		header("Location: /maintenance");
		exit;
	}
	$handle = opendir(dirname(realpath(__FILE__)).'/uploads/');
	while($file = readdir($handle)){
		if($file !== '.' && $file !== '..'){
			echo "\t\t\t<img src=\"uploads/".$file."\" border=\"0\" height=\"160px\" width=\"160px\" style=\"object-fit: contain;\" alt=\"".$file."\"/>\r\n";
		}
	}
	echo "\t\t</div>\r\n";
	echo "\t</body\r\n";
	echo "</html>"
?>