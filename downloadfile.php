<?php
/**
This page allows the user to download a file, the path and filename is sent
as a GET variable named "path".

Author:	Ivan Malmberg
		ivmalm@gmail.com
**/

include("includes/init.php");

//Checks that the user is currently logged in
checkAuthRedir();

//TODO: add permission checking for requested file

$file = $shared_dir . $_GET['path'];
//Checks that the file exists, that the path doesnt contain ".." and that the file isn't a directory.
if (file_exists($file) && stripos($suffix, "..") == false && !is_dir($file)) {
	//Log download
	logText($_SESSION['username'] . " downloaded " . mysql_real_escape_string($file));
	
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
} else {
	//Log invalid download attempt
	logText($_SESSION['username'] . " tried to download an invalid file!");
	die("Error: invalid file!");
}
?>