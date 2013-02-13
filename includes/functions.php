<?php
/**
This file contains functions used throughout the website.

Author:	Ivan Malmberg
		ivmalm@gmail.com
**/

/**
This function checks if a user exists based on crentials provided,
if a user exists this user is logged in, saved as a session and true is returned.

If a user doesn't exist false is returned.
**/
function authUser($username, $password) {
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	
	$result = mysql_query("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
	$row = mysql_fetch_array($result);
	if(mysql_num_rows($result) > 0) {
		if($row['isAdmin'] == 1 || $row['isAdmin'] == "1")
			$_SESSION['isAdmin'] = true;
		else
			$_SESSION['isAdmin'] = false;
			
		$_SESSION['auth'] = true;
		$_SESSION['username'] = $username;
		return true;
	} else {
		$_SESSION['auth'] = false;
		return false;
	}
}

/**
This function initializes the MySQL connection, must be done before any DB calls.
**/
function mysqlinit() {
	$link = mysql_connect('127.0.0.1', 'htk_user', 'umbrella');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("htk");
}

/**
This function checks if the currently logged in user can read a specific file,
returns true if allowed, false if not allowed.

FUNCTION NOT COMPLETE.

TODO: Add user info in WHERE-clause.
**/
function canRead($inode) {
	$inode = mysql_real_escape_string($inode);
	
	$result = mysql_query("SELECT * FROM `permissions` WHERE `inode` = '$inode'");
	$row = mysql_fetch_array($result);
	if($row['canRead'] == 1 || $row['canRead'] == "1")
		return true;
	else
		return false;
}

/**
This function checks if the currently logged in user can write a specific file,
returns true if allowed, false if not allowed.

FUNCTION NOT COMPLETE.

TODO: Add user info in WHERE-clause.
**/
function canWrite($inode) {
	$inode = mysql_real_escape_string($inode);
	
	$result = mysql_query("SELECT * FROM `permissions` WHERE `inode` = '$inode'");
	$row = mysql_fetch_array($result);
	if($row['canWrite'] == 1 || $row['canWrite'] == "1")
		return true;
	else
		return false;
}

/**
This function checks if the user is logged in,
returns true if the user is logged in and valid, false if not.
**/
function loggedIn() {
	if($_SESSION['auth'] == true && isset($_SESSION['username']))
		return true;
	else
		return false;
}

/**
Checks if the user that is currently logged in has admin privileges,
returns true if user has admin privileges, false if not.
**/
function isAdmin() {
	if($_SESSION['isAdmin'] && loggedIn())
		return true;
	else
		return false;
}

/**
Checks if the user is logged in,
if the user is not logged in he will be sent to the login page.
**/
function checkAuthRedir() {
	if(!loggedIn())
		header("Location: authhandler.php");
}

/**
Logs a message in the log.
**/
function logText($text) {
	$timestamp = date("Y-m-d H:i:s");
	$ip = $_SERVER['REMOTE_ADDR'];
	$text = mysql_real_escape_string($text);
	
	mysql_query("INSERT INTO `log` (`timestamp`, `ip`, `info`) VALUES ('$timestamp', '$ip', '$text')");
}
?>