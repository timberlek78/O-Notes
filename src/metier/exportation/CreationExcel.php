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

class ExcelExporter
{
	private $spreadsheet;
	private $nomFichier;
	private $cheminDossier;
	private $oNote;

	public function __construct($nomFichier, $cheminDossier)
	{
		$this->spreadsheet = new Spreadsheet();
		$this->nomFichier = $nomFichier;
		$this->cheminDossier = $cheminDossier;
		$this->oNote = new ONote();
	}

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
		for ($i = 1; $i<count($data) - 2; $i++) $sheet->setCellValue(chr(ord($colonne) + $i)."1", $data[$i]);
	}


	public function creerFeuilleCompetence($donneesCompetences, $donneesEtudiants)
	{
		$feuille = $this->spreadsheet->getActiveSheet();
		$colonne = 'G';
		foreach ($donneesCompetences as $index => $competence) {
			$feuille->setCellValue($colonne . '1', $competence->getLibelle());
			$ligne = 2;
			foreach ($donneesEtudiants as $etudiant) {
				$feuille->setCellValue($colonne . $ligne, $this->oNote->selectAdmis($competence, $etudiant, $this->oNote->selectById(1, $this->oNote->getEnsSemestre())));
				$ligne++;
			}
			$colonne++;
		}
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
