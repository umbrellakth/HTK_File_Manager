<?php
/**
Index page, initial point of entry.

Author:	Ivan Malmberg
		ivmalm@gmail.com
**/

include("includes/init.php");

//Checks if the user is logged in
if(loggedIn()) {
	header("Location: filebrowser.php");
} else {
	header("Location: authhandler.php");
}
?>