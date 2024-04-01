<?php
require '../../../lib/vendor/autoload.php';

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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ExcelExporter
{
	private $spreadsheet;
	private $nomFichier;
	private $cheminDossier;
	private $oNote;

	private const TAB_STATUT = ['ADM','CMP','ADSUP'];

    private const STYLE_TITRE = [
		'font'=>array(
			'bold'=>true,
			'size'=>11)
    ];

    private const STYLE_VERT = [
        'fill' => [
			'fillType' => Fill::FILL_SOLID,
			'startColor' => ['argb' => 'FF00FF00'], // Vert
		],
    ];

    // private const STYLE_ORANGE = [
    //     'bold' => false,
    //     'size' => 11,
    //     'fontColor' => '000000',
    //     'fond' => Fill::FILL_SOLID,
    //     'fondColor' => 'FFFF00',
    //     'alignement' => Alignment::HORIZONTAL_CENTER,
    //     'typeBordure' => Border::BORDER_THIN
    // ];

	private const STYLE_ROUGE = [
		'fill' => [
			'fillType' => Fill::FILL_SOLID,
			'startColor' => ['argb' => 'FF0000'], // Vert
		],
    ];

	public function __construct($nomFichier, $cheminDossier)
	{
		$this->spreadsheet = new Spreadsheet();
		$this->nomFichier = $nomFichier;
		$this->cheminDossier = $cheminDossier;
		$this->oNote = new ONote();	
	}


	// public function creerStyle($bold, $size, $fontColor, $fond, $fondColor,$alignement, $typeBordure) 
	// {
	// 	$style = new PhpOffice\PhpSpreadsheet\Style\Style();

	// 	//Appliquer les caracteristiques 
	// 	$style->getFont()->setBold($bold);
	// 	$style->getFont()->setSize($size);
	// 	$style->getFont()->getColor()->setARGB($fontColor); // Couleur de la police rouge
	// 	$style->getFill()->setFillType($fond);
	// 	$style->getFill()->getStartColor()->setARGB($fondColor); // Couleur de fond grise
	// 	$style->getAlignment()->setHorizontal($alignement); // Alignement horizontal au centre
	// 	$style->getBorders  ()->getTop()->setBorderStyle($typeBordure); // Bordure supérieure mince

	// 	return $style;
	// }

	public function creerFeuilleEtudiant($donneesEtudiants)
	{
		$feuille = $this->spreadsheet->getActiveSheet();
		$ligne = 2;

		$this->creerColonneEtudiant(array_keys($donneesEtudiants[0]->getAttributs()));
		foreach ($donneesEtudiants as $index => $etudiant) {
			$colonne     = 'A';
			$tabAttribut = array_values($etudiant ->getAttributs());
			for ($i = 0; $i < count($tabAttribut) - 3; $i++) 
			{
				if(is_array( $tabAttribut[$i] )) break;
				$feuille->setCellValue($colonne . $ligne, $tabAttribut[$i]);
				$colonne++;
			}
			$ligne++;
		}
	}

	public function creerColonneEtudiant($data,$colonne ="A")
	{
		$sheet = $this->spreadsheet->getActiveSheet(); 			
		for ($i = 0; $i<count($data) - 2; $i++) 
		{
			$sheet->setCellValue(chr(ord($colonne) + $i)."1", $data[$i]); 
			$sheet->getStyle    (chr(ord($colonne) + $i)."1"           )->applyFromArray(ExcelExporter::STYLE_TITRE);
		}
	}


	public function creerFeuilleCompetence($donneesCompetences, $donneesEtudiants)
	{
		$feuille = $this->spreadsheet->getActiveSheet();
		$colonne = 'G';
		foreach ($donneesCompetences as $index => $competence) {
			$feuille->setCellValue($colonne . '1', $competence->getLibelle());
			$ligne = 2;
			foreach ($donneesEtudiants as $etudiant) 
			{
				$admis = $this->oNote->selectAdmis($competence, $etudiant, $this->oNote->selectById(1, $this->oNote->getEnsSemestre()));

				if($this->estCool($admis)) $feuille->getStyle($colonne.$ligne)->applyFromArray(ExcelExporter::STYLE_VERT);
				else                       $feuille->getStyle($colonne.$ligne)->applyFromArray(ExcelExporter::STYLE_ROUGE);

				$feuille->setCellValue($colonne . $ligne, $admis );
				$ligne++;
			}
			$colonne++;
		}
	}

	public function estCool($admis)
	{
		foreach(ExcelExporter::TAB_STATUT as $str) 
			if($admis == $str) return true;
		return false;
	}

	public function creerColonneMoyenne($tab)
	{
		$feuille = $this->spreadsheet->getActiveSheet();
		$ligne   = 2;
		foreach($tab as $etudiant) 
		{
			$feuille->setCellValue("M".$ligne, $etudiant->getUe      ());
			$feuille->setCellValue("N".$ligne, $etudiant->getMoyenneG());
			$colonne       = "O";
			$indiceColonne =  0 ;
			foreach($etudiant->getTabMoyenne() as $key => $value)
			{
				$feuille->setCellValue( chr( ord($colonne) + $indiceColonne).$ligne, $value);
				$indiceColonne++;
			}
		}
	}

	public function enregistrer()
	{
		$writer        = new Xlsx($this->spreadsheet);
		$cheminFichier = $this->cheminDossier . '/' . $this->nomFichier;
		$writer->save($cheminFichier);
		return $cheminFichier;
	}
}

class GenerateurDonnees
{
	private $oNote;

	public function __construct()
	{
		$this->oNote = new ONote();
	}

	public function genererDonneesEtudiant  (){ return $this->oNote->getEnsEtudiant  (); }
	public function genererDonneesCompetence(){ return $this->oNote->getEnsCompetence(); }
}

// Utilisation
$generateurDonnees  = new GenerateurDonnees();
$donneesEtudiants   = $generateurDonnees->genererDonneesEtudiant();
$donneesCompetences = $generateurDonnees->genererDonneesCompetence();

$exportateur = new ExcelExporter('exemple.xlsx', 'C:\xampp\htdocs\O-Notes\data');
$exportateur->creerFeuilleEtudiant  (                     $donneesEtudiants);
$exportateur->creerFeuilleCompetence($donneesCompetences, $donneesEtudiants);
$exportateur->creerColonneMoyenne   (                     $donneesEtudiants);
$cheminFichier = $exportateur->enregistrer();

echo "Le fichier Excel a été créé avec succès : $cheminFichier";
?>
