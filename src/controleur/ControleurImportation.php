<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__.'/../../lib/vendor/autoload.php';

	include_once __DIR__.'/../metier/importation/OuvrirLectureExcel.inc.php';
	include_once __DIR__.'/../metier/importation/analyse/AnalyseDataFichiers.inc.php';
	include_once __DIR__.'/../metier/DonneesONote.inc.php';

	$dataMoyenne = OuvrirLectureExcel::OuvrirEtObtenirDataExcel( 'moyennes' );
	$dataJury    = OuvrirLectureExcel::OuvrirEtObtenirDataExcel( 'jury' );
	if( empty( $dataMoyenne ) || empty( $dataJury ) )
	{
		echo "Impossible d'ouvrir le fichier";
		exit( );
	}

	gererDonnees( $dataMoyenne, $dataJury );

	function gererDonnees( $dataMoyenne, $dataJury )
	{
		$donnes = new DonneesONote( );

		$analyse = new AnalyseDataFichiers( $dataMoyenne, $dataJury, $_POST[ 'promotion' ], $_POST[ 'semestre' ], true );
		$analyse->ajouterCompetencesDansDonnees( $donnes );
		$analyse->ajouterEtudiantsDansDonnees( $donnes );

		echo $donnes;
	}
?>