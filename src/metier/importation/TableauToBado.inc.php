<?php

require '../../../lib/vendor/autoload.php'; // Inclure l'autoloader de Composer

class TableauToBado
{
	private $tableauMoyennes;
	private $tableauJury;

	function __construct( string $fichierMoyennes, string $fichierJury, string $promotion, int $semestre, bool $enAlternance )
	{
		$excelMoyennes = new LectureExcel( $fichier );
		$excelJury = new LectureExcel( $fichier );

		$this->tableauMoyennes = $excelMoyennes->recupererDonnees();
		$this->tableauJury = $excelJury->recupererDonnees();
	}

	function parcourirColonnesMoyennes( $tableau )
	{

	}

?>