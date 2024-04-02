<?php

	require '../../../lib/vendor/autoload.php';
	/******************************************/
	/*       Importation des objets PHP       */
	/******************************************/

	include ("../../controleur/ControleurDB.inc.php" );
	include ("../../donnee/Competence.inc.php"       );
	include ("../../donnee/CompetenceMatiere.inc.php");
	include ("../../donnee/Cursus.inc.php"           );
	include ("../../donnee/Etude.inc.php"            );
	include ("../../donnee/Etudiant.inc.php"         );
	include ("../../donnee/EtudiantSemestre.inc.php" );
	include ("../../donnee/FPE.inc.php"              );
	include ("../../donnee/Illustration.inc.php"     );
	include ("../../donnee/Matiere.inc.php"          );
	include ("../../donnee/Possede.inc.php"          );
	include ("../../donnee/Semestre.inc.php"         );
	include ("../../donnee/Utilisateur.inc.php"      );

	class TableauToBado
	{
		private $tableauMoyennes;
		private $tableauJury;
		private $DB;

		function __construct( string $fichierMoyennes, string $fichierJury = null, string $promotion, int $semestre, bool $enAlternance )
		{
			$excelMoyennes = new LectureExcel( $fichierMoyennes );
			//$excelJury     = new LectureExcel(   $fichierJury   );

			$this->tableauMoyennes = $excelMoyennes->recupererDonnees();
			//$this->tableauJury     = $excelJury    ->recupererDonnees();

			$this->DB = DB::getInstance();
		}

		function creationEtudiant()
		{
			$tableau = $this->tableauMoyennes;
			$tab     = array();
			$nbColonne = count($tableau[0]);
			for($i = 1; $i < 10; $i++)
			{
				$etudiant = new Etudiant(intval($tableau[$i][1]), $tableau[$i][3],$tableau[$i][6],"A","2022-2023",$i);
				$this->DB->insert   ("Etudiant", $etudiant);		
			}
		}
	}
?>