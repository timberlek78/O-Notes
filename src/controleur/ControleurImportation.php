<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__.'/../../lib/vendor/autoload.php';

	include_once __DIR__.'/../metier/importation/OuvrirLectureExcel.inc.php';
	include_once __DIR__.'/../metier/importation/analyse/AnalyseDataFichiers.inc.php';
	include_once __DIR__.'/../donnee/DonneesONote.inc.php';
	include_once __DIR__.'/../metier/conversion/TableauToBado.inc.php';

	function genererDonnees( $dataMoyenne, $dataJury ) : DonneesONote
	{
		$donnes = new DonneesONote( );

		$existe = 
		$enAlternance = ( isset( $_POST['alternance'] ) && $_POST['alternance'] == '1' );

		$analyse = new AnalyseDataFichiers( $dataMoyenne, $dataJury, $_POST[ 'promotion' ], $_POST[ 'semestre' ], $enAlternance );
		$analyse->ajouterCompetencesDansDonnees( $donnes );
		$analyse->ajouterEtudiantsDansDonnees( $donnes );

		return $donnes;
	}

	function main ( )
	{
		$dataMoyenne = OuvrirLectureExcel::OuvrirEtObtenirDataExcel( 'moyennes' );
		$dataJury    = OuvrirLectureExcel::OuvrirEtObtenirDataExcel( 'jury' );
		if( empty( $dataMoyenne ) || empty( $dataJury ) )
		{
			echo "Impossible d'ouvrir le fichier";
			exit( );
		}

		$donnees = genererDonnees( $dataMoyenne, $dataJury );

		//echo $donnees;

		$conversion = new TableauToBado( $donnees );
		$conversion->insertAll( );
	}

	main( );
?>