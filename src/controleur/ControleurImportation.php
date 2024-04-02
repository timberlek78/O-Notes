<?php
	//remplace la classe "GestionExcels"
	//remarque : toutes les classes utilisées comme appel par l'html (gestion formulaire etc) seraient dans ce dossier controleur

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__.'/../../lib/vendor/autoload.php';

	include_once '../metier/importation/LectureExcel.inc.php';
	include_once '../metier/importation/moyennes/AnalyseDataMoyennes.inc.php';

	ouvrirFichierMoyennes( );
	ouvrirFichierJury( );


	function ouvrirFichierMoyennes( )
	{
		$fichierValide = isset( $_FILES[ 'moyennes' ] ) && $_FILES[ 'fichier' ][ 'error' ] === UPLOAD_ERR_OK;

		if( $fichierValide )
		{
			$chemin_fichier = $_FILES[ 'fichier' ][ 'tmp_name' ];

			$handle = fopen( $chemin_fichier, "r" );

			if( $handle )
			{
				$fichier = $_FILES[ 'fichier' ][ 'tmp_name' ];
				$excel = new LectureExcel( $fichier );
				$data = $excel->recupererDonnees( );

				$analyse = new AnalyseDataMoyennes( $data, $_POST[ 'promotion' ], $_POST[ 'semestre' ], true );
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
	}

	function ouvrirFichierJury( )
	{
		$fichierValide = isset( $_FILES[ 'jury' ] ) && $_FILES[ 'fichier' ][ 'error' ] === UPLOAD_ERR_OK;

		if( $fichierValide )
		{
			$chemin_fichier = $_FILES[ 'fichier' ][ 'tmp_name' ];

			$handle = fopen( $chemin_fichier, "r" );

			if( $handle )
			{
				$fichier = $_FILES[ 'fichier' ][ 'tmp_name' ];
				$excel = new LectureExcel( $fichier );
				$data = $excel->recupererDonnees( );

				$analyse = new AnalyseDataJury( $data, $_POST[ 'semestre' ] );
				$analyse->majPassageEtudiantSemestre( );
				$analyse->majAdmissionCursus( );
			}

			fclose( $handle );
		}
		else
		{
			echo "Impossible d'ouvrir le fichier";
		}
	}
?>