<?php
require __DIR__.'/../../../../lib/vendor/autoload.php'; // Inclure l'autoloader généré par Composer

// Importer la classe FPDF
use FPDF;

class CreationPdf
{
    private $fpdf;
    private $etudiant;

    public function __construct($etudiant)
    {
        $this->etudiant = $etudiant;
        $this->fpdf = new FPDF();
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial', '', 8);
    }

	public function creerInfoEtudiant()
	{
		// Définir la largeur totale du bloc final
		$largeurBlocFinal = 130;

		// Calculer le nombre de cellules et la largeur de chaque cellule
		$nbCellules = 6;
		$largeurCellule = $largeurBlocFinal / $nbCellules;

		$this->fpdf->Cell(0, 8, iconv('UTF-8', 'windows-1252', 'Informations de l\'étudiant'), 0, 1, 'L');

		// Première ligne du tableau
		$this->fpdf->Cell(60, 8, iconv('UTF-8', 'windows-1252', 'NOM – Prénom :'), 1, 0, 'L');
		$this->fpdf->Cell(130, 8, iconv('UTF-8', 'windows-1252', 'BOUDEELE Thomas'), 1, 1, 'L');

		// Deuxième ligne du tableau
		$this->fpdf->Cell(60, 8, iconv('UTF-8', 'windows-1252', 'Apprentissage : (oui/non)'), 1, 0, 'L');
		for ($i = 1; $i <= 3; $i++) {
			$this->fpdf->Cell($largeurCellule, 8, iconv('UTF-8', 'windows-1252', 'BUT' . $i), 1, 0, 'L');
			$this->fpdf->Cell($largeurCellule, 8, iconv('UTF-8', 'windows-1252', 'OUI'), 1, 0, 'L');
		}
		$this->fpdf->Ln(); // Aller à la ligne après chaque ligne de cellules

		// Troisième ligne du tableau
		$this->fpdf->Cell(60, 8, iconv('UTF-8', 'windows-1252', 'Parcours d\'études'), 1, 0, 'L');
		$textesCellules = array('n-2', 'S1 S2', 'n-1', 'S3 S4', 'n', 'S5 S6');
		foreach ($textesCellules as $texte) {
			$this->fpdf->Cell($largeurCellule, 8, iconv('UTF-8', 'windows-1252', $texte), 1, 0, 'L');
		}
		$this->fpdf->Ln();

		// Quatrième ligne du tableau
		$this->fpdf->Cell(60, 8, iconv('UTF-8', 'windows-1252', 'Parcours BUT'), 1, 0, 'L');
		$this->fpdf->Cell(130, 8, iconv('UTF-8', 'windows-1252', 'A "« Réalisation d\'applications : conception, développement, validation »"'), 1, 1, 'L');

		// Cinquième ligne du tableau
		$this->fpdf->Cell(60, 8, iconv('UTF-8', 'windows-1252', 'Si mobilité à l\'étranger (lieu, durée)'), 1, 0, 'L');
		$this->fpdf->Cell(130, 8, iconv('UTF-8', 'windows-1252', ''), 1, 1, 'L');
	}

    public function creerTableauCompetences($competences)
    {
        $this->fpdf->Cell(90, 8, 'RÉSULTATS DES COMPÉTENCES', 0, 1, 'C');
        $this->fpdf->Cell(90, 8, '', 0, 0, 'C');
        $this->fpdf->Cell(30, 8, 'BUT 1', 1, 0, 'C');
        $this->fpdf->Cell(30, 8, 'BUT 2', 1, 1, 'C');

        foreach ($competences as $competence) {
            $this->fpdf->Cell(90, 8, iconv('UTF-8', 'windows-1252', $competence), 1, 0, 'L');
            for ($i = 0; $i < 4; $i++) {
                $this->fpdf->Cell(15, 8, '', 1, 0, 'C');
            }
            $this->fpdf->Ln();
        }
    }

	public function creerTabAvis()
	{
		$this->fpdf->SetFillColor(255, 255, 255);
	
		// En-tête du tableau
		$header = ['', '', 'Très Favorable', 'Favorable', 'Assez Favorable', 'Favorable', 'Sans avis', 'Réservé'];
		$this->fpdf->Cell(46, 8, '', 0); // Pour aligner le tableau
		foreach ($header as $col) {
			$this->fpdf->Cell(23, 8, $col, 1, 0, 'L', true);
		}
		$this->fpdf->Ln();
	
		// Contenu du tableau
		$data = [
			['Pour l’étudiant', '', '□', '□', '□', '□', '□', '□'],
			['Avis pour la poursuite en école d’ingénieurs', '', '', '', '', '', '', ''],
			['Avis pour la poursuite en Master', '', '', '', '', '', '', '']
		];
	
		foreach ($data as $row) {
			foreach ($row as $col) 
			{
				$this->fpdf->Cell(23, 15, iconv('UTF-8', 'windows-1252', $col), 1, 0, 'L');
			}
			$this->fpdf->Ln();
		}
	}

    public function exporter()
    {
        $this->fpdf->Output('../../../../data/AAA.pdf', 'F');
    }
}

// Définition de la classe Etudiant
class Etudiant
{
    private $nomPrenom;
    private $parcoursBUT;

    public function __construct($nomPrenom, $parcoursBUT)
    {
        $this->nomPrenom = $nomPrenom;
        $this->parcoursBUT = $parcoursBUT;
    }

    public function getNomPrenom()
    {
        return $this->nomPrenom;
    }

    public function getParcoursBUT()
    {
        return $this->parcoursBUT;
    }
}

// Création d'un objet étudiant
$etudiant = new Etudiant('BOUDEELE Thomas', 'A "« Réalisation d\'applications : conception, développement, validation »"');

// Création d'un objet PDF avec l'étudiant
$pdf = new CreationPdf($etudiant);

// Création des informations de l'étudiant
$pdf->creerInfoEtudiant();

// Définition des compétences
$competences = [
    'UE1 – Réaliser des applications',
    'UE2 – Optimiser des applications',
    'UE3 – Administrer des systèmes',
    'UE4 – Gérer des données',
    'UE5 – Conduire des projets',
    'UE6 – Collaborer',
];

// Création du tableau des compétences
$pdf->creerTableauCompetences($competences);

// Création du tableau des avis
$pdf->creerTabAvis();

// Export du PDF
$pdf->exporter();

// Afficher un message de confirmation
echo "Le fichier PDF a été généré avec succès!";
