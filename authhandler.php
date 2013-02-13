<?php
/**
This file contains login/logout functionality.

Author:	Ivan Malmberg
		ivmalm@gmail.com
**/

include("includes/init.php");

if($_GET['action'] == "logout") { //Logout
	logText($_SESSION['username'] . " logged out!");
	//Destroy the session
	session_destroy();
	//Redirect to index page
	header("Location: /");
	//Halt execution
	die();
} elseif(loggedIn()) { //Check if we are already logged in
	//If so, redirect to index page
	header("Location: /");
	die();
} elseif(isset($_POST['username'])) {
	//Check if the credentials provided are valid
	if(authUser($_POST['username'], $_POST['password'])) {
		//Log user login
		logText($_SESSION['username'] . " logged in!");
		//Redirect to filebrowser
		header("Location: filebrowser.php");
		//Halt execution
		die();
	} else { //Invalid user credentials
		//Log failed login attempt
		logText("Failed login attempt!");
		$wrongPasswd = true;
	}
}

include("includes/header.php");
//Print message if wrong password
if($wrongPasswd)
		echo "<div class='errorbox'>Wrong username and/or password!</div>";
?>
<div id="loginbox">
	<p>Enter your username and password log in!</p>
	<form action="" method="post">
		<input type="text" name="username" id="username" /><br />
		<input type="password" name="password" id="password" /><br />
		<input type="submit" value="Login" />
	</form>
</div>

<?php
include("includes/footer.php");
?>