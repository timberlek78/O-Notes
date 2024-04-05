<?php

require __DIR__.'/../../../lib/vendor/autoload.php'; // Inclure l'autoloader de Composer
include_once __DIR__.'/LectureExcel.inc.php';
require_once __DIR__.'/Import.inc.php';

class OuvrirLectureExcel
{
	private $fichier;

	private function __construct( $fichier ) //$_FILES
	{
		$this->fichier = $fichier;
	}

	public static function OuvrirEtObtenirDataExcel( $fichier ) : array
	{
		$ouvrirLectureExcel = new OuvrirLectureExcel( $fichier );

		if( $ouvrirLectureExcel->fichierExcelValide( ) )
		{
			return $ouvrirLectureExcel->creerEtObtenirData( );
		}
		else
		{
			return array( );
		}
	}

	private function fichierExcelValide( ) : bool
	{
		return $this->fichierExiste( ) && $this->fichierSansErreur( ) && $this->fichierTypeExcel( );
	}

	private function fichierExiste( ) : bool
	{
		return isset( $this->fichier );
	}

	private function fichierSansErreur( ) : bool
	{
		return ( $this->fichier[ 'error' ] === UPLOAD_ERR_OK );
	}

	private function fichierTypeExcel( ) : bool
	{
		$mime = $this->fichier[ 'type' ];
		return ( $mime === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
	}

	private function creerEtObtenirData( ) : array
	{
		$chemin_fichier = $this->fichier[ 'tmp_name' ];

		$excel = new LectureExcel( $chemin_fichier );
		$data = $excel->recupererDonnees( );

		return $data;
	}
}
?>
