<?php

require '../../../lib/vendor/autoload.php'; // Inclure l'autoloader de Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

class LectureExcel
{
	private string $fichier;
	private $feuillePrincipale;

	public function __construct( string $fichier )
	{
		$this->fichier = $fichier;
		$this->chargerFeuille( );
	}

	private function chargerFeuille( )
	{
		$tableur = $this->chargerFichier();
		$this->feuillePrincipale = $tableur->getActiveSheet( );
		$this->feuillePrincipale;
	}

	private function chargerFichier() : PhpOffice\PhpSpreadsheet\Spreadsheet
	{
		$reader = IOFactory::createReaderForFile( $this->fichier );
		$spreadsheet = $reader->load( $this->fichier );
		return $spreadsheet;
	}

	public function recupererDonnees() : array
	{
		$data = $this->feuillePrincipale->toArray( );
		return $data;
	}

	//toString
	public function __toString( ) : string
	{
		$titre = "Fichier : " . $this->fichier;
		$donnees = $this->recupererDonnees( );
		return OutilTableau::genererTableauHtml( $donnees, $titre );
	}
}
?>