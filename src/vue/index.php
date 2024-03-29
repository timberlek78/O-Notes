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

			$objet = new Etudiant(456852,"Lavoine","Maxime","A","2023-2024",1);

			$db->insert("Etudiant",$objet);

			echo $db->selectAll("Etudiant");
		?>
	</body>
</html>