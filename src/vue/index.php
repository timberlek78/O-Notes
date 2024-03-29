<!DOCTYPE html>
<html>
	<head>
		<title>O'Notes</title>
	</head>
	<body>
		<?php

			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

			include ("../controleur/ControleurDB.inc.php");

			$db = DB::getInstance();
		?>
		<form action="./metier/importation.php">
			<input type="file" />
		</form>
	</body>
</html>