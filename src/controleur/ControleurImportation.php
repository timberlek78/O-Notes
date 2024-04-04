<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__.'/../../lib/vendor/autoload.php';

	include_once __DIR__.'/../metier/importation/OuvrirLectureExcel.inc.php';
	include_once __DIR__.'/../metier/importation/analyse/AnalyseDataFichiers.inc.php';
	include_once __DIR__.'/../metier/DonneesONote.inc.php';
	include_once __DIR__.'/../metier/conversion/TableauToBado.inc.php';

	function importerAvecTableau ( array $tabImports )
	{
		foreach ( $tabImports as $import )
		{
			$dataMoyenne = OuvrirLectureExcel::OuvrirEtObtenirDataExcel( $import->getFichierMoyenne() );
			$dataJury    = OuvrirLectureExcel::OuvrirEtObtenirDataExcel( $import->getFichierJury() );
			if( empty( $dataMoyenne ) || empty( $dataJury ) )
			{
				echo "Impossible d'ouvrir le fichier";
				exit( );
			}

			$donnees = genererDonnees( $dataMoyenne, $dataJury, $import->getAnnee(), $import->getSemestre(), $import->estAlternance() );

			//echo $donnees;

			echo "debut du traitement";
			$conversion = new TableauToBado( $donnees );
			echo "fin du traitement, début de l'insertion";
			$conversion->insertAll( );
			echo "fin de l'insertion";
		}
	}

	function importerSansTableau ( )
	{
		$dataMoyenne = OuvrirLectureExcel::OuvrirEtObtenirDataExcel( $_FILES[ 'moyenne' ] );
		$dataJury    = OuvrirLectureExcel::OuvrirEtObtenirDataExcel( $_FILES[ 'jury' ] );
		if( empty( $dataMoyenne ) || empty( $dataJury ) )
		{
			echo "Impossible d'ouvrir le fichier";
			exit( );
		}

		$enAlternance = ( isset( $_POST['alternance'] ) && $_POST['alternance'] == '1' );

		$donnees = genererDonnees( $dataMoyenne, $dataJury, $_POST[ 'promotion' ], $_POST[ 'semestre' ], $enAlternance );

		//echo $donnees;

		$conversion = new TableauToBado( $donnees );
		$conversion->insertAll( );
	}

	function genererDonnees( $dataMoyenne, $dataJury, string $promotion, int $semestre, bool $enAlternance ) : DonneesONote
	{
		$donnes = new DonneesONote( );

		$analyse = new AnalyseDataFichiers( $dataMoyenne, $dataJury, $promotion, $semestre, $enAlternance );
		$analyse->ajouterCompetencesDansDonnees( $donnes );
		$analyse->ajouterEtudiantsDansDonnees( $donnes );

		return $donnes;
	}

	//importerSansTableau( );
?>