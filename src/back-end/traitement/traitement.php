<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	var_dump($_FILES['avatar']);



	if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK)
	{
		$chemin_fichier = $_FILES['avatar']["tmp_name"];

		$handle = fopen($chemin_fichier,"r");

		if($handle)
		{
			while(($ligne = fgets($handle)) !== false)
			{
				echo $ligne;
			}
		}

		fclose($handle);
	}
	else
	{
		echo "Impossible d'ouvrir le fichier";
	}

	
?>