<?php
/**
This file provides a browsable file list view.

Author:	Ivan Malmberg
		ivmalm@gmail.com
**/

include("includes/init.php");

//Check if we are logged in
checkAuthRedir();

include("includes/header.php");

$suffix = $_GET['dir'] . "/";
$shared_dir = $shared_dir . $suffix;

//Print current path, also escape HTML characters to avoid XSS
echo "<p>" . htmlspecialchars($shared_dir) . "</p>";

//Check that the path doesn't contain ".." and that we can read the files
if(stripos($suffix, "..") == false && $entries = scandir($shared_dir)) {
	//Print table header
	echo "<table id='filetable'>
			<tr>
				<th>Filename</th>
				<th>Actions</th>
			</tr>";
	//Do two loops through the directory
	for($i = 0; $i < 2; $i++) {
		foreach($entries as $entry) {
			$character = substr($entry, 0, 1);
			//Don't print if path starts with a dot
			if($character != ".") {
				//Only print diretories in the first pass
				if(is_dir($shared_dir . $entry) && $i == 0) {
					echo "
					<tr>
						<td>
							<img src='gfx/Folder-icon.png' height='20' alt='Folder icon' /> <a href='?dir=" . $suffix . $entry . "'>$entry</a>
						</td>
						<td><img src='gfx/delete-icon.png' height='18' alt='Delete' /></td>
					</tr>\n";
				} elseif(!is_dir($shared_dir . $entry) && $i == 1) { //Only print files in the 2nd pass
					echo "
					<tr>
						<td>
							<img src='gfx/File-txt-icon.png' height='20' alt='File icon'> $entry
						</td>
						<td>
							<a href='downloadfile.php?path=" . $suffix . $entry . "'><img src='gfx/Download-icon.png' height='18' alt='Download icon' /></a> 
							<img src='gfx/delete-icon.png' height='18' alt='Delete' />
						</td>
					</tr>\n";
				}
			}
		}
	}
	//Print table footer
	echo "</table>";
} else {
	echo "<div class='errorbox'>Invalid path!</div>";
}

include("includes/footer.php");
?>