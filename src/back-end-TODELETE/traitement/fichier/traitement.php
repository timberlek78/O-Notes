<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	//var_dump($_FILES['avatar']);

	include_once './ecriture.php';
	include_once './lecture.php';

	if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK)
	{
		$chemin_fichier = $_FILES['avatar']["tmp_name"];

		$handle = fopen($chemin_fichier,"r");

		if($handle)
		{
			/*while(($ligne = fgets($handle)) !== false)
			{
				echo $ligne;
			}*/
			
			$fichier = uploadFile( $_FILES['avatar'] ); //attention ça déplace le fichier temporaire
			var_dump($_FILES['avatar']['tmp_name']);
			var_dump($fichier['tmp_name']);

			$data = loadFile( $fichier );
			displayData( $data );
		}

		fclose($handle);
	}
	else
	{
		echo "Impossible d'ouvrir le fichier";
	}

	
?>