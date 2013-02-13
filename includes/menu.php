<div id="menu">
	<ul>
		<li><a href="filebrowser.php">File browser</a></li>
		<li><a href="authhandler.php?action=logout">Logout</a></li>
	</ul>
	<?php
	if(isAdmin()) {
	?>
		<div id="adminMenu">
			Admin menu contents
		</div>
	<?php
	}
	?>
</div>