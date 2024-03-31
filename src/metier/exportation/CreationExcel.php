<?php

	echo "jejej";
	require '../../../lib/vendor/autoload.php'; // Inclure l'autoloader de PhpSpreadsheet
	include '../../donnee/Etudiant.inc.php';
	include '../../controleur/ControleurDB.inc.php';

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL & ~E_WARNING);



	use PhpOffice\PhpSpreadsheet\Reader\Xls\Style\Border;
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Style\Borders;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	class ExcelExporter
	{
		private $spreadsheet;
		private $fileName;
		private $folderPath;

		private $borders;

		public function __construct($fileName, $folderPath)
		{
			$this->spreadsheet = new Spreadsheet();
			$this->fileName = $fileName;
			$this->folderPath = $folderPath;
		}

		public function creerColonne($data)
		{
			//var_dump($data);

			$sheet = $this->spreadsheet->getActiveSheet(); 
			$colonne = "A";
			for ($i = 0; $i<count($data) - 2; $i++) 
			{
				$sheet->setCellValue(chr(ord($colonne) + $i)."1", $data[$i]);
			}
		}

		public function remplirColonne($data)
		{
			$sheet = $this->spreadsheet->getActiveSheet(); 
			for($i = 2; $i<count($data); $i++)
			{
				$sheet->setCellValue("A".$i, $data[$i]->getNIP     ());
				$sheet->setCellValue("B".$i, $data[$i]->getNom     ());
				$sheet->setCellValue("C".$i, $data[$i]->getPrenom  ());
				$sheet->setCellValue("D".$i, $data[$i]->getParcours());
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

	// Exemple d'utilisation :
	$etu  = new Etudiant(13,"ba","aa","A","a",-1);
	$data = array_keys($etu->getAttributs());

	$folderPath = 'C:\xampp\htdocs\O-Notes\data'; // Modifier avec le chemin de votre dossier
	$fileName = 'example.xlsx';

	$exporter = new ExcelExporter($fileName, $folderPath);
	$exporter->creerColonne($data);
	$db     = DB::getInstance();


	$exporter->remplirColonne($db->selectAll('Etudiant'));	
	$filePath = $exporter->save();

	echo "Le fichier Excel a été créé avec succès : $filePath";

?>
