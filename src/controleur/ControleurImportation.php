<?php
	//remplace la classe "GestionExcels"
	//remarque : toutes les classes utilisées comme appel par l'html (gestion formulaire etc) seraient dans ce dossier controleur

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__.'/../../lib/vendor/autoload.php';

	include_once '../metier/importation/LectureExcel.inc.php';
	include_once '../metier/importation/moyennes/AnalyseDataMoyennes.inc.php';

	/*require '../metier/OutilsTableau.inc.php';*/

	$fichierValide = isset( $_FILES[ 'fichier' ] ) && $_FILES[ 'fichier' ][ 'error' ] === UPLOAD_ERR_OK;

	if( $fichierValide )
	{
		$chemin_fichier = $_FILES[ 'fichier' ][ 'tmp_name' ];

		$handle = fopen( $chemin_fichier, "r" );

		if( $handle )
		{
			$fichier = $_FILES[ 'fichier' ][ 'tmp_name' ];
			$excel = new LectureExcel( $fichier );
			$data = $excel->recupererDonnees( );

			$analyse = new AnalyseDataMoyennes( $data, "2024-test", 1, true );
			$analyse->analyserCompetences( );
			$analyse->analyserEtudiants( );

			/*$tableauHtml = genererTableauHtml( $data );
			echo $tableauHtml;*/
		}

		fclose( $handle );
	}
	else
	{
		echo "Impossible d'ouvrir le fichier";
	}
?>