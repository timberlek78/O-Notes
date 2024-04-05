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
			var_dump($this->etudiant->estApprentie());
			$sheet->setCellValue($colonne.$ligne,$this->etudiant->estApprentie());
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
	echo "je usi sa";
    $sheet = $this->spreadsheet->getActiveSheet();

    $ligne = 31; // Ligne de départ pour les compétences
    $colonne = 'D'; // Colonne de départ pour les compétences

    $bins = $this->etudiant->getTabMoyenne(); // Stocker le tableau tabMoyenne dans une variable pour faciliter l'accès

    $fillCompetencesCalled = false; // Variable pour garder une trace de l'appel à fillCompetences

    foreach ($bins as $bin => $moyenne) 
    {
		echo "je suis la";
        // Vérifier si le premier chiffre de BIN est pair
        $firstDigit = (int)$bin[3]; // Obtenez le premier chiffre de BIN (par exemple, 2 pour "BIN21")
        $binne = substr($bin,0,4);

        if ($firstDigit % 2 === 0) 
        {
            // Définir les compétences associées
            $this->fillCompetences($sheet, $colonne, $ligne, $binne, $bins);
            $fillCompetencesCalled = true; // Marquer fillCompetences appelé

            // Rechercher la prochaine BIN pair
            while (++$firstDigit % 2 !== 0 && $firstDigit <= 4) {
                $binne = "BIN" . ++$firstDigit;
            }

            if ($firstDigit > 4) {
                // Il n'y a plus de BIN pair après BIN4
                break;
            }
        }

        if ($firstDigit === 5 && !$fillCompetencesCalled) {
            // Si firstDigit est 5 et fillCompetences n'a pas été appelé, appeler fillCompetences une fois
            $this->fillCompetences($sheet, $colonne, $ligne, $binne, $bins);
            $fillCompetencesCalled = true; // Marquer fillCompetences appelé
        }
    }

    // Remplir les cellules restantes avec des nombres aléatoires
    $nombre_aleatoire = rand(0, 2000) / 100;
    $sheet->setCellValue('D25', number_format($nombre_aleatoire, 2) );

    $nombre_aleatoire = rand(0, 2000) / 100;
    $sheet->setCellValue('D26', number_format($nombre_aleatoire, 2) );

    $nombre_aleatoire = rand(0, 2000) / 100;
    $sheet->setCellValue('F25', number_format($nombre_aleatoire, 2) );

    $nombre_aleatoire = rand(0, 2000) / 100;
    $sheet->setCellValue('F26', number_format($nombre_aleatoire, 2) );
}


	private function fillCompetences($sheet, &$colonne, &$ligne, $binne, $bins)
	{
		for ($i = 1; $i <= 6; $i++) 
		{

			$nombre_aleatoire = rand(0, 2000) / 100;
    		$sheet->setCellValue('D25', number_format($nombre_aleatoire, 2) );
			$sheet->setCellValue($colonne . $ligne, $nombre_aleatoire);
			$ligne++;
		}

		// Sauter 2 colonnes pour la prochaine BIN
		$colonne = chr(ord($colonne) + 2);
	}


	public function informationCompetence2()
	{
		$sheet = $this->spreadsheet->getActiveSheet();
	
		$ligne = 19; // Ligne de départ pour les compétences
		$colonne = 'D'; // Colonne de départ pour les compétences
	
		$bins = $this->etudiant->getTabMoyenne(); // Stocker le tableau tabMoyenne dans une variable pour faciliter l'accès
	
		$fillCompetencesCalled = false; // Variable pour garder une trace de l'appel à fillCompetences
	
		foreach ($bins as $bin => $moyenne) 
		{
			// Vérifier si le premier chiffre de BIN est pair
			$firstDigit = (int)$bin[3]; // Obtenez le premier chiffre de BIN (par exemple, 2 pour "BIN21")
			$binne = substr($bin,0,4);
	
			
			if ($firstDigit == 5) 
			{
				// Définir les compétences associées
				$this->fillCompetences($sheet, $colonne, $ligne, $binne, $bins);
	
				// Rechercher la prochaine BIN pair
				while (++$firstDigit % 2 !== 0 && $firstDigit <= 4) {
					$binne = "BIN" . ++$firstDigit;
				}
	
			}
		}
	
		// Remplir les cellules restantes avec des nombres aléatoires
		$nombre_aleatoire = rand(0, 2000) / 100;
		$sheet->setCellValue('D25', number_format($nombre_aleatoire, 2) );
	
		$nombre_aleatoire = rand(0, 2000) / 100;
		$sheet->setCellValue('D26', number_format($nombre_aleatoire, 2) );
	
		$nombre_aleatoire = rand(0, 2000) / 100;
		$sheet->setCellValue('F25', number_format($nombre_aleatoire, 2) );
	
		$nombre_aleatoire = rand(0, 2000) / 100;
		$sheet->setCellValue('F26', number_format($nombre_aleatoire, 2) );
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
		$writer->save($outputPath);


		// Output PDF to file
		$writer->save($outputPath);
	}
}
