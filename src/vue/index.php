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

			$objet = new FPE("Duflot",2021,2023);

			echo $db->insert("FPE",$objet);

			$tab = $db->selectAll("FPE");

			var_dump($tab[1]->getId());
			echo "aaa";



			$db->delete("FPE",$objet);

			var_dump($db->selectAll("FPE"));
		?>
	</body>
</html>