<?php
	//remplace la classe "GestionExcels"
	//remarque : toutes les classes utilisées comme appel par l'html (gestion formulaire etc) seraient dans ce dossier controleur

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__.'/../../lib/vendor/autoload.php';

	include_once '../metier/importation/LectureExcel.inc.php';
	include_once '../metier/importation/moyennes/AnalyseDataMoyennes.inc.php';
	include_once '../metier/DonneesONote.inc.php';

	ouvrirFichierMoyennes( );

	function fichierValide( string $nomFichier ) : bool
	{
		return isset( $_FILES[ $nomFichier ] ) && $_FILES[ $nomFichier ][ 'error' ] === UPLOAD_ERR_OK;
	}

	function ouvrirFichierMoyennes( )
	{
		if( fichierValide( 'moyennes' ) )
		{
			$chemin_fichier = $_FILES[ 'moyennes' ][ 'tmp_name' ];

			$excel = new LectureExcel( $chemin_fichier );
			$data = $excel->recupererDonnees( );

			gererFichierMoyennes( $data );
		}
		else
		{
			echo "Impossible d'ouvrir le fichier";
		}
	}

	//TODO: sortir le constructeur DonneesONote de la fonction
	function gererFichierMoyennes( $data )
	{
		$donnes = new DonneesONote( );

		$analyse = new AnalyseDataMoyennes( $data, $_POST[ 'promotion' ], $_POST[ 'semestre' ], true );
		$analyse->ajouterCompetencesDansDonnees( $donnes );
		$analyse->ajouterEtudiantsDansDonnees( $donnes );

		echo $donnes;
	}

	//TODO: refactoriser comme pour moyennes
	/*function ouvrirFichierJury( )
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
	}*/
?>