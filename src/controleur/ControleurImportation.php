<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__.'/../../lib/vendor/autoload.php';

	include_once __DIR__.'/../metier/importation/OuvrirLectureExcel.inc.php';
	include_once __DIR__.'/../metier/importation/analyse/AnalyseDataFichiers.inc.php';
	include_once __DIR__.'/../metier/importation/analyse/AnalyseDataCoefficients.inc.php';
	include_once __DIR__.'/../donnee/DonneesONote.inc.php';
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
		$dataCoef    = OuvrirLectureExcel::OuvrirEtObtenirDataExcel( $_FILES[ 'coef' ] );
		if( empty( $dataMoyenne ) || empty( $dataJury ) )
		{
			echo "Impossible d'ouvrir le fichier";
			exit( );
		}

		$enAlternance = ( isset( $_POST['alternance'] ) && $_POST['alternance'] == '1' );

		$donnees = genererDonnees( $dataMoyenne, $dataJury, $dataCoef, $_POST[ 'promotion' ], $_POST[ 'semestre' ], $enAlternance );

		echo $donnees;

		$conversion = new TableauToBado( $donnees );
		$conversion->insertAll( );
	}

	function genererDonnees( $dataMoyenne, $dataJury, $dataCoef, string $promotion, int $semestre, bool $enAlternance ) : DonneesONote
	{
		$donnees = new DonneesONote( );

		$analyse = new AnalyseDataFichiers( $dataMoyenne, $dataJury, $promotion, $semestre, $enAlternance );
		$analyse->ajouterCompetencesDansDonnees( $donnees );
		$analyse->ajouterEtudiantsDansDonnees( $donnees );

		if( ! empty( $dataCoef ) )
		{
			$NB_SEMESTRES = 6;
			$analyse = new AnalyseDataCoefficients( $dataCoef, $promotion, $NB_SEMESTRES, $enAlternance );
			$analyse->completer( $donnees );
		}

		return $donnees;
	}

	//à décommenter pour les test avec "testLectureExcel"
	importerSansTableau( );
?>