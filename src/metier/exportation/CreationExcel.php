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
	private $semestre;
	private $oNote;

	private $colonneFINI;
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
		$this->spreadsheet   = new Spreadsheet();
		$this->nomFichier    = $nomFichier;
		$this->cheminDossier = $cheminDossier;
		//$this->semestre      = $semestre;
		$this->oNote = new ONote();	
	}

	public function getSemestre() { return $this->semestre;}
	public function getColonneFINI() {return $this->colonneFINI;}


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
		$ligne = 9;
		$this->creerColonneEtudiant(array_keys($donneesEtudiants[0]->getAttributExcel()), 'A');
		foreach ($donneesEtudiants as $index => $etudiant) {
			$colonne     = 'A';
			$tabAttribut = array_values($etudiant ->getAttributExcel());
			for ($i = 0; $i < count($tabAttribut) ; $i++) 
			{
				echo "<br> colonne : ".$colonne."<br>";
				if(is_array( $tabAttribut[$i] )) break;
				$feuille->setCellValue($colonne . $ligne, $tabAttribut[$i]);
				$colonne++;
			}
			$ligne++;
		}
	}

	public function creerColonneEtudiant($data,$colonne)
	{
		$sheet = $this->spreadsheet->getActiveSheet(); 			
		for ($i = 0; $i<count($data); $i++) 
		{
			if(is_array( $data[$i] )) break;

			$sheet->getColumnDimension(chr(ord($colonne) + $i))->setWidth(strlen($data[$i]) + 15);
			$sheet->setCellValue(chr(ord($colonne) + $i)."8",$data[$i]); 
			$sheet->getStyle    (chr(ord($colonne) + $i)."8"           )->applyFromArray(ExcelExporter::STYLE_TITRE);
		}
	}


	public function creerFeuilleCompetence($donneesCompetences, $donneesEtudiants)
	{
		$feuille    = $this->spreadsheet->getActiveSheet();
		$colonne    = 'G';
		$ligne      =  9;

		echo "<br>";
		var_dump( $donneesEtudiants[0]->getTabCursus() );
		echo "<br>";

		foreach ($donneesEtudiants[0]->getTabCursus() as $but=>$tabCompetence)
		{
			var_dump($colonne);
			$this->creerEncadreCompetence($but, $colonne, $tabCompetence);
			$colonne = chr(ord($colonne) + count(array_keys($tabCompetence)));;
		}
	}

	public function remplirFeuilleCompetence($donneesCompetences, $donneesEtudiants)
	{
		$feuille = $this->spreadsheet->getActiveSheet();
		$ligne   = 9;
	
		foreach ($donneesEtudiants as $etudiant)
		{
			$colonneCompetence = 'G';
			foreach($etudiant->getTabCursus() as $but=>$tabCompetence)
			{
				
				foreach($tabCompetence as $cursus)
				{
					$admis = $cursus->getAdmission();
		
					$feuille->setCellValue($colonneCompetence.$ligne, $admis);
					if($this->estCool($admis)) $feuille->getCell($colonneCompetence.$ligne)->getStyle()->applyFromArray(ExcelExporter::STYLE_VERT );
					else                       $feuille->getCell($colonneCompetence.$ligne)->getStyle()->applyFromArray(ExcelExporter::STYLE_ROUGE);

					$colonneCompetence++;
				}
				$this->colonneFINI = $colonneCompetence;
			}
			$ligne++;
		}

		
	}

	public function creerEncadreCompetence(string $but, string $colonne,$tabCompetence)
	{
		$ligne           = 7;
		$ligneCompetence = 8;
		$colonneArrive   = chr(ord($colonne) + count(array_keys($tabCompetence))- 1);
		$espace          = $colonne.$ligne.':'.$colonneArrive.$ligne;

		$feuille = $this->spreadsheet->getActiveSheet();
		$feuille->setCellValue($colonne.$ligne, strtoupper($but));
		$feuille->getCell     ($colonne.$ligne)->getStyle()->applyFromArray(ExcelExporter::STYLE_TITRE);

		foreach( $tabCompetence as $libelle => $admission)
		{
			$feuille->setCellValue($colonne.$ligneCompetence, $libelle);
			$feuille->getColumnDimension(chr(ord($colonne)))->setWidth(strlen($libelle) + 5);
			$feuille->getCell     ($colonne.$ligneCompetence)->getStyle()->applyFromArray(ExcelExporter::STYLE_TITRE);
			$colonne++;
		}

		$feuille->mergeCells($espace);

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
		$ligne   = 9;
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

$exportateur = new ExcelExporter('exemple.xlsx', '../../../data');
$exportateur->creerFeuilleEtudiant    (                      $donneesEtudiants);
$exportateur->creerFeuilleCompetence  ($donneesCompetences , $donneesEtudiants);
$exportateur->remplirFeuilleCompetence( $donneesCompetences, $donneesEtudiants);

echo "<br> LAAAAAAAAAAAA :".$exportateur->getColonneFini()."<br>";
//$exportateur->creerColonneMoyenne     (                      $donneesEtudiants);
$cheminFichier = $exportateur->enregistrer();

echo "<br>Le fichier Excel a été créé avec succès : $cheminFichier";
?>


//TODO: Voir si rajouter le semstre que l'on veut dans le excel peut faciliter les choses, il faut une méthode qui parcours tout les semestres jusqu'a semstre voulu.
