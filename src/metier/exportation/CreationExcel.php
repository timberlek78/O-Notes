<?php
	require '../../../lib/vendor/autoload.php'; // Inclure l'autoloader de PhpSpreadsheet

	include '../../controleur/ControleurDB.inc.php';
	include '../../donnee/Competence.inc.php';
	include '../../donnee/CompetenceMatiere.inc.php';
	include '../../donnee/Cursus.inc.php';
	include '../../donnee/Etude.inc.php';
	include '../../donnee/Etudiant.inc.php';
	include '../../donnee/EtudiantSemestre.inc.php';
	include '../../donnee/FPE.inc.php';
	include '../../donnee/Illustration.inc.php';
	include '../../donnee/Matiere.inc.php';
	include '../../donnee/Possede.inc.php';
	include '../../donnee/Semestre.inc.php';
	include '../../donnee/Utilisateur.inc.php';
	
	include '../ONotes.php';

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL & ~E_WARNING);


	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	class ExcelExporter
	{
		private $spreadsheet;
		private $fileName;
		private $folderPath;
		private $oNote;
		private $borders;

		public function __construct($fileName, $folderPath)
		{
			$this->spreadsheet = new Spreadsheet();
			$this->fileName    = $fileName;
			$this->folderPath  = $folderPath;
			$this->oNote       = new ONote();
		}

		public function getONotes()
		{
			return $this->oNote;
		}

		public function creerColonneEtudiant($data,$colonne ="A")
		{
			$sheet = $this->spreadsheet->getActiveSheet(); 			
			for ($i = 1; $i<count($data) - 2; $i++) $sheet->setCellValue(chr(ord($colonne) + $i)."1", $data[$i]);
		}

		public function remplirColonneEtudiant($data)
		{
			$sheet = $this->spreadsheet->getActiveSheet();
			$ligne = 2; 
			for($i = 0; $i<count($data); $i++)
			{
				$sheet->setCellValue("A".$ligne, $data[$i]->getNIP     ());
				$sheet->setCellValue("B".$ligne, $data[$i]->getNom     ());
				$sheet->setCellValue("C".$ligne, $data[$i]->getPrenom  ());
				$sheet->setCellValue("D".$ligne, $data[$i]->getParcours());

				$ligne++;
			}
		}

		public function creerColonneCompetence($data)
		{
			$colonne = "G";
			$sheet = $this->spreadsheet->getActiveSheet();
			for ($i = 0; $i<count($data); $i++) $sheet->setCellValue(chr(ord($colonne) + $i)."1", $data[$i]->getLibelle());
		}

		public function remplirColonneCompetence ($tabCompetence, $tabEtudiant)
		{
			$sheet = $this->spreadsheet->getActiveSheet();
			$ligne = 2;	
			$colonne = "G";
			for($i = 0; $i<count($tabCompetence); $i++)
			{
				$colonne = chr(ord($colonne) + $i);
				$ligne = 2;
				for($j = 0; $j<count($tabEtudiant); $j++)
				{
					echo $colonne.$ligne;
					$sheet->setCellValue($colonne.$ligne,$this->oNote->selectAdmis($tabCompetence[$i], $tabEtudiant[$j], $this->oNote->selectSemestreById(1)));
					$ligne++;
				}
			}
		}

		public function save()
		{
			$writer = new Xlsx($this->spreadsheet);
			// Créer le chemin complet du fichier Excel
			$filePath = $this->folderPath . '/' . $this->fileName;
			// Sauvegarder le fichier Excel
			$writer->save($filePath);
			return $filePath;
		}
	}

	$db = DB::getInstance();

	// Exemple d'utilisation :
	$etu  = new Etudiant(-1,13,"ba","aa","A","a",-1);
	$data = array_keys($etu->getAttributs());

	$folderPath = 'C:\xampp\htdocs\O-Notes\data'; // Modifier avec le chemin de votre dossier
	$fileName = 'example.xlsx';

	$exporter = new ExcelExporter    ($fileName, $folderPath);
	$exporter->creerColonneEtudiant  ($data);

	$exporter->remplirColonneEtudiant($exporter->getONotes()->getEnsEtudiant());

	$exporter->creerColonneCompetence  ($exporter->getONotes()->getEnsCompetence());

	//var_dump($exporter->getONotes()->getEnsEtudiant());

	$exporter->remplirColonneCompetence($exporter->getONotes()->getEnsCompetence(), $exporter->getONotes()->getEnsEtudiant());


	$filePath = $exporter->save();

	echo "Le fichier Excel a été créé avec succès : $filePath";

?>
