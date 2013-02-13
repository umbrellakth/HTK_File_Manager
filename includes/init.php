<?php
/**
This file contains initialization functions and global variables/settings.

IMPORTANT: This file must be included in all pages and also included before header.php if it is required!

Author:	Ivan Malmberg
		ivmalm@gmail.com
**/
error_reporting(E_ALL & ~E_NOTICE);
require_once("functions.php");

mysqlinit();
session_start();

/** GLOBAL VARIABLES **/
$shared_dir = "/var/www/htk.sytes.net/shared_dir";

$initialized = true;
?>