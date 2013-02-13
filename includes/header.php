<?php
/**
This is the header file that prints the HTML header, menu etc.

Author:	Ivan Malmberg
		ivmalm@gmail.com
**/

//This file must not be included in any page before init.php has been included for initialization purposes
if($initialized == false || !isset($initialized))
	die("init must be called before header inclusion");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>HTK</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div id="container">
			<div id="header">
				<img src="gfx/logo.png" alt="HTK LOGO" height="120" />
			</div>
			<?php
			//Print the menu if logged in.
			if(loggedIn()) {
				include("includes/menu.php");
			}
			?>
			<div id="content">
			