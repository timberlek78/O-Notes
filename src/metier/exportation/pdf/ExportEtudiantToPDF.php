<?php
require __DIR__.'/../../../../lib/vendor/autoload.php'; // Chemin vers autoload.php de PhpSpreadsheet
require __DIR__.'/../../../donnee/IncludeAll.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ExportEtudiantToPDF
{
	protected $etudiant;
	protected $excelFile;
	protected $spreadsheet;

	public function __construct($etudiant, $excelFile)
	{
		$this->etudiant    = $etudiant;
		$this->excelFile   = $excelFile;
		$this->spreadsheet = IOFactory::load($excelFile);
	}

	public function informationEtudiant()
	{
		$sheet = $this->spreadsheet->getActiveSheet();

		var_dump($this->etudiant->getNom());
		$sheet->setCellValue('D9',$this->etudiant->getNom().' '.$this->etudiant->getPrenom().'');

		$colonne = 'E';
		$ligne   = '10';
		for($i= 0;$i<3;$i++ ) 
		{
			$sheet->setCellValue($colonne.$ligne,$this->etudiant->estApprentie('BUT'.$i));
			$colonne = chr(ord($colonne) + 2);
		}

		$colonne = 'E';
		$ligne   = '11';
		for($i= 0;$i<3;$i++ ) 
		{
			$s = "";
			foreach($this->etudiant->getTabCursus() as $str) $s .= $str;

			$sheet->setCellValue($colonne.$ligne,$s);
			$colonne = chr(ord($colonne) + 2);
		}

		$sheet->setCellValue('D12', 'A "Réalisation d\'applications : conception, développement, validation');
	}

	public function informationCompetence1()
	{
		$sheet = $this->spreadsheet->getActiveSheet();

		$colonne = 'D';
		$ligne   = 19;
		foreach($this->etudiant->getTabMoyenne() as $moyenne)
		{
			$sheet->setCellValue($colonne.$ligne, $moyenne);
			$ligne++;
		}
	}



	public function informationCompetence2()
	{
		$sheet = $this->spreadsheet->getActiveSheet();

		$colonne = 'D';
		$ligne   = 31;
		foreach($this->etudiant->getTabMoyenne() as $moyenne)
		{
			$sheet->setCellValue($colonne.$ligne, $moyenne);
			$ligne++;
		}
	}

	public function fillSkillsTable($data)
	{
		
	}

	public function exportToPDF($outputPath)
	{
		$this->informationEtudiant();
		$this->informationCompetence1();
		$this->informationCompetence2();

		// Convert Excel to PDF
		$tempFile = tempnam(sys_get_temp_dir(), 'excel');
		$writer        = new Xlsx($this->spreadsheet);
		$writer->save($tempFile);


		// Output PDF to file
		$writer->save($outputPath);
	}
}
