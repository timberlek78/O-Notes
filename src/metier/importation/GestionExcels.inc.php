<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../../../lib/vendor/autoload.php';
	include_once './LectureExcel.inc.php';
	include './TableauToBado.php';

	require '../OutilTableau.inc.php';

	$fichierValide = isset( $_FILES['fichier'] ) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK;

	if( $fichierValide )
	{
		$chemin_fichier = $_FILES['fichier']["tmp_name"];

		$handle = fopen( $chemin_fichier, "r" );

		if( $handle )
		{
			$fichier = $_FILES['fichier']['tmp_name'];
			$excel = new LectureExcel( $fichier );
			$data = $excel->recupererDonnees();

			$tabBADO = new TableauToBado($fichier,null,"2022-2023",1,false);
			$tabBADO->creationEtudiant();


		}
		fclose($handle);
	}
	else
	{
		echo "Impossible d'ouvrir le fichier";
	}
?>