<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__.'/../../lib/vendor/autoload.php';

	include_once '../metier/importation/LectureExcel.inc.php';
	include_once '../metier/importation/analyse/AnalyseDataFichiers.inc.php';
	include_once '../metier/DonneesONote.inc.php';

	if( fichierValide( 'moyennes' ) && fichierValide( 'jury' ) )
	{
		$dataMoyenne = ouvrirFichier( 'moyennes' );
		$dataJury    = ouvrirFichier( 'jury' );
		gererDonnees( $dataMoyenne, $dataJury );
	}
	else
	{
		echo "Impossible d'ouvrir le fichier";
	}

	function fichierValide( string $nomFichier ) : bool
	{
		return isset( $_FILES[ $nomFichier ] ) && $_FILES[ $nomFichier ][ 'error' ] === UPLOAD_ERR_OK;
	}

	function ouvrirFichier( string $nomFichier ) : array
	{
		$chemin_fichier = $_FILES[ $nomFichier ][ 'tmp_name' ];

		$excel = new LectureExcel( $chemin_fichier );
		$data = $excel->recupererDonnees( );

		return $data;
	}

	//TODO: sortir le constructeur DonneesONote de la fonction ?
	function gererDonnees( $dataMoyenne, $dataJury )
	{
		$donnes = new DonneesONote( );

		$analyse = new AnalyseDataFichiers( $dataMoyenne, $dataJury, $_POST[ 'promotion' ], $_POST[ 'semestre' ], true );
		$analyse->ajouterCompetencesDansDonnees( $donnes );
		$analyse->ajouterEtudiantsDansDonnees( $donnes );

		echo $donnes;
	}
?>