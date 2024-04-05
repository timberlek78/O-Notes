<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/../../../lib/vendor/autoload.php';

include '../../controleur/ControleurDB.inc.php';

require_once '../../donnee/IncludeAll.php';

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
	private $limiteSemestre;
	private const TAB_STATUT = ['ADM','CMP','ADSUP'];

	private const STYLE_TITRE = [
		'font'=>array(
			'bold'=>true,
			'size'=>11)
	];

	private const STYLE_BORDURE = [
		'borders' => [
			'allBorders' => [
				'borderStyle' => Border::BORDER_THIN, // Style de bordure mince
				'color' => ['argb' => 'FF000000'], 
			],
		],
	];

	private const STYLE_BORDURE_GRAS = [
		'borders' => [
			'allBorders' => [
				'borderStyle' => Border::BORDER_THICK, // Style de bordure ENORME ou MEDIUM
				'color' => ['argb' => 'FF000000'], 
			],
		],
	];

	private const STYLE_VERT = [
		'fill' => [
			'fillType' => Fill::FILL_SOLID,
			'startColor' => ['argb' => 'FFbbdfbc'], // Vert
		],
		'font' => [
			'color' => ['argb' => 'FF062b16'], 
		],
	];

	private const STYLE_ROUGE = [
		'fill' => [
			'fillType' => Fill::FILL_SOLID,
			'startColor' => ['argb' => 'f1bcbb'], // Rouge
		],
		'font' => [
			'color' => ['argb' => '7b0000'], 
		],
	];

	private const STYLE_ORANGE = [
		'fill' => [
			'fillType' => Fill::FILL_SOLID,
			'startColor' => ['argb' => 'ffd5b9'], // Orange
		],
		'font' => [
			'color' => ['argb' => 'a34100'], 
		],
	];

	public function __construct($nomFichier, $cheminDossier, $semestre)
	{
		$this->spreadsheet    = new Spreadsheet();
		$this->nomFichier     = $nomFichier;
		$this->cheminDossier  = $cheminDossier;
		$this->limiteSemestre = $semestre;
		$this->oNote = new ONote();	
	}

	public function getSemestre()             { return $this->semestre;}
	public function getColonneFINI() : string { return $this->colonneFINI;}
	public function getLimiteSemestre() : int { return $this->limiteSemestre;}


	public function creerFeuilleEtudiant($donneesEtudiants)
{
	$feuille = $this->spreadsheet->getActiveSheet();
	$ligne = 9;
	$this->creerColonneEtudiant(array_keys($donneesEtudiants[0]->getAttributExcel()), 'A');

	foreach ($donneesEtudiants as $index => $etudiant) {
		$colonne = 'A';
		$tabAttribut = array_values($etudiant->getAttributExcel());

		foreach ($tabAttribut as $attribut) 
		{

			if (is_array($attribut)) 
			{

				// Si l'attribut est un tableau associatif, le concaténer en une seule chaîne
				$valeur = implode(', ', $attribut); // Changer le séparateur si nécessaire

			} else {
				$valeur = $attribut;
			}

			$feuille->setCellValue($colonne . $ligne, $valeur);
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
//Passer en argument un semestre limite et regarder a chaque itération 

	public function creerColonneBUT($donneeEtudiant)
	{
	$feuille = $this->spreadsheet->getActiveSheet();
	$ligne   = 9;
	$colonne = "G";
	$etudiant = $donneeEtudiant[0];

	foreach($etudiant->getTabBUT() as $but)
	{
		echo "JESUS EST LA";
		if($this->estSemestreLimite($this->limiteSemestre, $but))
		{
			echo "JESUS EST LA";

			if($this->limiteSemestre % 2 == 0)
			{
				$this->afficherValeur($but, $colonne, "BUT ".$but->getNum(), $but->getSemestrePair());
			}
			else
			{
				$this->afficherValeur($but, $colonne, "Semestre ".$but->getNumSemestreImpair(), $but->getSemestreImpair());
			}
		}
		else
		{
			$this->afficherValeur($but, $colonne, "BUT ".$but->getNum(), $but->estComplet() ? $but->getSemestrePair() : $but->getSemestreImpair());
		}
	}
	}

	public function afficherValeur($but, &$colonne, $titre, $competences)
	{
		$this->creerEncadreCompetence($titre, $colonne, $competences,false);
		$colonne = chr(ord($colonne) + count(array_values($competences)));
	}

	public function estSemestreLimite($limite, $but)
	{
		$keysSemestrePair   = $but->getNumSemestrePair();
		$keysSemestreImpair = $but->getNumSemestreImpair();

		return $limite == $keysSemestrePair || $limite == $keysSemestreImpair;
	}

	public function remplierColonneBUT($donneeEtudiant)	
	{
		$feuille = $this->spreadsheet->getActiveSheet();
		$ligne   = 9;
		$colonne = "G";

		foreach($donneeEtudiant as $etudiant)
		{
			$colonne = "G";
			foreach($etudiant->getTabBUT() as $but)
			{
				if($but->estComplet())
				{
					$colonne = $this->mettreValeurBut($colonne,$ligne, $but->getSemestrePair());
				}
				else
				{
					$colonne = $this->mettreValeurBut($colonne,$ligne, $but->getSemestreImpair());
				}
				
				$this->colonneFINI = $colonne;
			}
			$ligne++;
		}
	}

	public function mettreValeurBut($colonne,$ligne, $tab)
	{
		$feuille = $this->spreadsheet->getActiveSheet();

		foreach( $tab as $competence)
		{
			$admis = $competence->getAdmission();
		
			$feuille->setCellValue($colonne.$ligne, $admis);
			if($this->estCool($admis)) $feuille->getCell($colonne.$ligne)->getStyle()->applyFromArray(array_merge( ExcelExporter::STYLE_VERT , ExcelExporter::STYLE_BORDURE ));
			else                       $feuille->getCell($colonne.$ligne)->getStyle()->applyFromArray(array_merge( ExcelExporter::STYLE_ROUGE, ExcelExporter::STYLE_BORDURE ));

			$colonne = chr(ord($colonne) + 1);
		}
		return $colonne;
	}

	public function creerEncadreCompetence(string $but, string $colonne,$tabCompetence,$ue, ?int $nbEtudiant = 0)
	{
		$ligne           = 7;
		$ligneCompetence = 8;
		$colonneArrive   = chr(ord($colonne) + count(array_keys($tabCompetence))- 1);
		$ligneArrive     = $ligne + $nbEtudiant + 1;
		$espace          = $colonne.$ligne.':'.$colonneArrive.$ligne;
		$encadrer        = $colonne.($ligne+1).':'.$colonneArrive.$ligneArrive;

		$feuille = $this->spreadsheet->getActiveSheet();
		$feuille->setCellValue($colonne.$ligne, strtoupper($but));
		$feuille->getCell     ($colonne.$ligne)->getStyle()->applyFromArray(ExcelExporter::STYLE_TITRE);

		$index = 1;

		foreach( $tabCompetence as $libelle => $valeur)
		{
			if($ue)
			{
				$feuille->setCellValue($colonne.$ligneCompetence, $valeur); 
				$feuille->getColumnDimension($colonne)->setWidth(strlen($valeur) + 5);
			}
			else  
			{
				$feuille->getColumnDimension(chr(ord($colonne)))->setWidth(strlen($libelle) + 5);
				$feuille->setCellValue($colonne.$ligneCompetence, "C".$index);
			}

			$feuille->getCell     ($colonne.$ligneCompetence)->getStyle()->applyFromArray(ExcelExporter::STYLE_TITRE);
			$colonne++;
			$index++;
		}

		$feuille->mergeCells($espace);
		$feuille->getStyle($encadrer)->applyFromArray(ExcelExporter::STYLE_BORDURE);
	}

	public function estCool($admis)
	{
		foreach(ExcelExporter::TAB_STATUT as $str) 
			if($admis == $str) return true;
		return false;
	}

	public function creerColonneMoyenne($donneeEtudiant)
	{
		$tabCompetence[] = "UE";
		$tabCompetence[] = "Moyenne";
		$tabCompetence = array_merge($tabCompetence,array_keys($donneeEtudiant[0]->getTabMoyenne()));

		var_dump($tabCompetence);

		$this->creerEncadreCompetence("UE du S".$this->getLimiteSemestre() ,$this->getColonneFINI(),$tabCompetence, true, count($donneeEtudiant));
	}

	public function remplirColonneMoyenne($donneeEtudiant)
	{
		$feuille = $this->spreadsheet->getActiveSheet();
		$colonne = chr(ord($this->getColonneFINI()) + 2) ;
		$ligne   = 9;
		foreach($donneeEtudiant as $etudiant)
		{
			echo "<br>";
			$feuille->setCellValue($this->getColonneFINI().$ligne, $etudiant->getUe());
			//$feuille->getCell     ($this->getColonneFINI().$ligne)->getStyle()->applyFromArray($this->appliquerStyleUe($etudiant->getUe()));


			$feuille->setCellValue(chr((ord($this->getColonneFINI()) + 1  )).$ligne, $etudiant->getMoyenneG());
			$feuille->getCell($this->getColonneFINI().$ligne)->getStyle()->applyFromArray(ExcelExporter::STYLE_BORDURE);

			$colonne = chr(ord($this->getColonneFINI()) + 2) ;
			foreach($etudiant->getTabMoyenne() as $moyenne)
			{
				$feuille->setCellValue($colonne.$ligne, $moyenne);
				
				if($moyenne > 10) $feuille->getCell($colonne.$ligne)->getStyle()->applyFromArray(array_merge( ExcelExporter::STYLE_VERT , ExcelExporter::STYLE_BORDURE ));
				else              $feuille->getCell($colonne.$ligne)->getStyle()->applyFromArray(array_merge( ExcelExporter::STYLE_ROUGE, ExcelExporter::STYLE_BORDURE ));

				$colonne++;
			}
			$ligne++;
		}
	}

	public function appliquerStyleUe($Ue)
	{
		var_dump( intval( $Ue[0] ) );
		if      ( intval($Ue[0]) == 6 || intval($Ue[0]) == 5 ) return array_merge( ExcelExporter::STYLE_VERT,   ExcelExporter::STYLE_BORDURE );
		else if ( intval($Ue[0]) == 0                        ) return array_merge( ExcelExporter::STYLE_ROUGE,  ExcelExporter::STYLE_BORDURE );
		else if ( intval($Ue[0]) <=  4                       ) return array_merge( ExcelExporter::STYLE_ORANGE, ExcelExporter::STYLE_BORDURE );
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
$donneesEtudiants   = $generateurDonnees->genererDonneesEtudiant  ();
$donneesCompetences = $generateurDonnees->genererDonneesCompetence();

$exportateur = new ExcelExporter('exemple.xlsx', '../../../data', 6);
$exportateur->creerFeuilleEtudiant    ( $donneesEtudiants );
$exportateur->creerColonneBUT         ( $donneesEtudiants );
$exportateur->remplierColonneBUT      ( $donneesEtudiants );
$exportateur->creerColonneMoyenne     ( $donneesEtudiants );
$exportateur->remplirColonneMoyenne   ( $donneesEtudiants );

//var_dump($exportateur->getColonneFINI() );

$cheminFichier = $exportateur->enregistrer();

echo "<br>Le fichier Excel a été créé avec succès : $cheminFichier";
?>