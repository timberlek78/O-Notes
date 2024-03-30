<?php

	
	// Inclure l'autoloader de Composer
	require_once '../../../lib/vendor/autoload.php';

	include_once '../../controleur/ControleurDB.inc.php';

	// Importer les classes nécessaires de PhpSpreadsheet
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


	class CreationExcel
	{
		private $DB;

		private function __construct()
		{
			$this->DB = DB::getInstance();
		}

		public function fichierJury()
		{
			$classeur = new Spreadsheet();

			$feuilleActive = $classeur->getActiveSheet();

			$feuilleActive-> setTitle('PV Jury'); //TODO Mettre la date dans le jury

			$etudiantTEST = new Etudiant(1,'test','test','test','test',-1);

			$tabAttributEtudiant = $etudiantTEST->getAttributs();

			$colonne = 'A';
			foreach($tabAttributEtudiant as $cle=>$valeur)
			{
				$feuilleActive->setCellValue(($colonne + $i++).'8', $cle );
			}

			$ecrivain      = new Xlsx($classeur);
			$cheminFichier = 'C:\xampp\htdocs\O-Notes\data';

			$ecrivain ->save($cheminFichier);

			echo 'Le fichier excel Jury a bien été crée';
		}
	}



?>