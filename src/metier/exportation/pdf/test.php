<?php
require __DIR__.'/../../../../lib/vendor/autoload.php'; // Inclure l'autoloader généré par Composer

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Importer la classe FPDF
use FPDF;

class CreationPdf
{
	private $fpdf;
	private $etudiant;
	private $largeurBUT;
	private $largeurOUI;

	public function __construct()
	{
		//$this->etudiant = $etudiant;
		$this->fpdf = new FPDF();

		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial', '', 10);

		// Définir les largeurs des cellules BUT et OUI
		$this->largeurBUT = 30;
		$this->largeurOUI = 20;
	}


	public function creerInfoEtudiant()
{
	// Définir la largeur totale du bloc final
	$largeurBlocFinal = 130;

	// Calculer le nombre de cellules et la largeur de chaque cellule
	$nbCellules = 6; // Le nombre total de cellules
	$largeurCellule = $largeurBlocFinal / $nbCellules;

	$this->fpdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Informations de l\'étudiant'), 0, 1, 'L');

	// Première ligne du tableau
	$this->fpdf->Cell(60, 10, iconv('UTF-8', 'windows-1252', 'NOM – Prénom :'), 1, 0, 'L');
	$this->fpdf->Cell(130, 10, iconv('UTF-8', 'windows-1252', 'BOUDEELE Thomas'), 1, 1, 'L');

	// Deuxième ligne du tableau
	$this->fpdf->Cell(60, 10, iconv('UTF-8', 'windows-1252', 'Apprentissage : (oui/non)'), 1, 0, 'L');
	for ($i = 1; $i <= 3; $i++) {
		$this->fpdf->Cell($largeurCellule, 10, iconv('UTF-8', 'windows-1252', 'BUT' . $i), 1, 0, 'L');
		$this->fpdf->Cell($largeurCellule, 10, iconv('UTF-8', 'windows-1252', 'OUI'), 1, 0, 'L');
	}
	$this->fpdf->Ln(); // Aller à la ligne après chaque ligne de cellules

	// Troisième ligne du tableau
	$this->fpdf->Cell(60, 10, iconv('UTF-8', 'windows-1252', 'Parcours d\'études'), 1, 0, 'L');
	$textesCellules = array('n-2', 'S1 S2', 'n-1', 'S3 S4', 'n', 'S5 S6');
	foreach ($textesCellules as $texte) {
		$this->fpdf->Cell($largeurCellule, 10, iconv('UTF-8', 'windows-1252', $texte), 1, 0, 'L');
	}
	$this->fpdf->Ln(); // Aller à la ligne après chaque ligne de cellules

	// Quatrième ligne du tableau
	$this->fpdf->Cell(60, 10, iconv('UTF-8', 'windows-1252', 'Parcours BUT'), 1, 0, 'L');
	$this->fpdf->Cell(130, 10, iconv('UTF-8', 'windows-1252', 'A "« Réalisation d\'applications : conception, développement, validation »"'), 1, 1, 'L');

	// Cinquième ligne du tableau
	$this->fpdf->Cell(60, 10, iconv('UTF-8', 'windows-1252', 'Si mobilité à l\'étranger (lieu, durée)'), 1, 0, 'L');
	$this->fpdf->Cell(130, 10, iconv('UTF-8', 'windows-1252', ''), 1, 1, 'L');
}


	public function exporter()
	{
		$this->fpdf->Output('../../../../data/AAA.pdf', 'F');
	}
}

$pdf = new CreationPdf();
$pdf->creerInfoEtudiant();
$pdf->exporter();


// Afficher un message de confirmation
echo "Le fichier PDF a été généré avec succès!";
