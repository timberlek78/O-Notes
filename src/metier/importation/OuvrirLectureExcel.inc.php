<?php

require __DIR__.'/../../../lib/vendor/autoload.php'; // Inclure l'autoloader de Composer
include_once __DIR__.'/LectureExcel.inc.php';

class OuvrirLectureExcel
{
	private string $nomFichier;

	private function __construct( string $nomFichier )
	{
		$this->nomFichier = $nomFichier;
	}

	public static function OuvrirEtObtenirDataExcel( string $nomFichier ) : array
	{
		$ouvrirLectureExcel = new OuvrirLectureExcel( $nomFichier );

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
		return isset( $_FILES[ $this->nomFichier ] );
	}

	private function fichierSansErreur( ) : bool
	{
		return ( $_FILES[ $this->nomFichier ][ 'error' ] === UPLOAD_ERR_OK );
	}

	private function fichierTypeExcel( ) : bool
	{
		$mime = $_FILES[ $this->nomFichier ][ 'type' ];
		return ( $mime === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
	}

	private function creerEtObtenirData( ) : array
	{
		$chemin_fichier = $_FILES[ $this->nomFichier ][ 'tmp_name' ];

		$excel = new LectureExcel( $chemin_fichier );
		$data = $excel->recupererDonnees( );

		return $data;
	}
}
?>
