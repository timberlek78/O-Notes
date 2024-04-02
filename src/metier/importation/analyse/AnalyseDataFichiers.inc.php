<?php

require_once 'AnalyseStructureMoyennes.inc.php';
require_once 'AnalyseStructureJury.inc.php';

require_once __DIR__.'/../../../donnee/IncludeAll.php';

class AnalyseDataFichiers
{
	private array $tableauMoyenne;
	private array $tableauJury;
	private AnalyseStructureMoyennes $structureMoyenne;
	private AnalyseStructureJury     $structureJury;

	private string $promotion;
	private int    $semestre;
	private bool   $enAlternance;

	public function __construct( array $tableauMoyenne, array $tableauJury, string $promotion, int $semestre, bool $enAlternance )
	{
		$this->tableauMoyenne = $tableauMoyenne;
		$this->tableauJury    = $tableauJury;
		$this->structureMoyenne = new AnalyseStructureMoyennes( $this->tableauMoyenne[ 0 ], $semestre );
		$this->structureJury    = new AnalyseStructureJury( $this->tableauJury[ 0 ], $semestre );

		$this->promotion    = $promotion;
		$this->semestre     = $semestre;
		$this->enAlternance = $enAlternance;
	}

	public function ajouterCompetencesDansDonnees( DonneesONote $donnes )
	{
		$semestre = $this->creerSemestre( );
		$donnes->semestre = $semestre;

		$ensNomCompetence = $this->structureMoyenne->getCompetences( $this->semestre );
		foreach( $ensNomCompetence as $nomCompetence )
		{
			$competence = $this->creerCompetence( $nomCompetence );
			$donnes->ensCompetence[] = $competence;

			$ensNomMatiere = $this->structureMoyenne->getRessourcesCompetence( $nomCompetence );
			foreach( $ensNomMatiere as $nomMatiere )
			{
				$matiere = $this->creerMatiere( $nomMatiere );
				$donnes->ensMatiere[] = $matiere;

				$competenceMatiere = $this->creerCompetenceMatiere( $nomCompetence, $nomMatiere );
				$donnes->ensCompetenceMatiere[] = $competenceMatiere;
			}
		}
	}

	public function ajouterEtudiantsDansDonnees( DonneesONote $donnees )
	{
		for( $cptEtudiant = 1; $cptEtudiant < count( $this->tableauMoyenne ); $cptEtudiant++ )
		{
			$ligneMoyenne = $this->tableauMoyenne[ $cptEtudiant ];
			$ligneJury    = $this->tableauJury[ $cptEtudiant ];

			$etudiant = $this->creerEtudiant( $ligneMoyenne );
			$donnees->ensEtudiant[] = $etudiant;

			$etude = $this->creerEtude( $ligneMoyenne );
			$donnees->ensEtude[] = $etude;

			$etudiantSemestre = $this->creerEtudiantSemestre( $ligneMoyenne );

			$this->majPassageEtudiantSemestre( $donnees, $ligneJury, $etudiantSemestre );

			$donnees->ensEtudiantSemestre[] = $etudiantSemestre;

			$this->ajouterCursusDansDonnees( $donnees, $ligneJury, $etudiant->getCodeNIP( ) );
			$this->ajouterEstNoteDansDonnees( $donnees, $ligneMoyenne, $etudiant->getCodeNIP( ) );
		}
	}

	private function majPassageEtudiantSemestre( DonneesONote $donnees, array $ligneJury, EtudiantSemestre $etudiantSemestre )
	{
		$indice = $this->structureJury->getIndiceColonne( "admission" );
		$admission = $ligneJury[ $indice ] . ""; //REMARQUE : je n'ai pas trouvé pourquoi il fallait ajouter une chaine vide
		$etudiantSemestre->setPassage( $admission );
	}

	private function ajouterCursusDansDonnees( DonneesONote $donnees, array $ligneJury, string $codeNIP )
	{
		$ensNomCompetence = $this->structureMoyenne->getCompetences( $this->semestre );
		foreach( $ensNomCompetence as $nomCompetence )
		{
			$cursus = $this->creerCursus( $codeNIP, $nomCompetence );
			
			$colonneApresMoyenne = $this->structureJury->getIndiceColonne( $nomCompetence ) + 1;
			$cursus->setAdmission( $ligneJury[ $colonneApresMoyenne ] );

			$donnees->ensCursus[] = $cursus;
		}
	}

	private function ajouterEstNoteDansDonnees( DonneesONote $donnees, array $ligneMoyenne, string $codeNIP )
	{
		$ensNomMatiere = $this->structureMoyenne->getMatieresDistinctes( );
		foreach( $ensNomMatiere as $nomMatiere )
		{
			$moyenne = floatval( $ligneMoyenne[ $this->structureMoyenne->getIndiceColonneMatiere( $nomMatiere ) ] );

			$estNote = $this->creerEstNote( $ligneMoyenne, $codeNIP, $nomMatiere, $moyenne );
			$donnees->ensEstNote[] = $estNote;
		}
	}

	private function creerEtudiant( array $ligne ) : Etudiant
	{
		$etudiant = new Etudiant( );
		$etudiant->setCodeNIP( $ligne[ $this->structureMoyenne->getIndiceColonne( "codeNIP" ) ] );
		$etudiant->setNom( $ligne[ $this->structureMoyenne->getIndiceColonne( "nom" ) ] );
		$etudiant->setPrenom( $ligne[ $this->structureMoyenne->getIndiceColonne( "prenom" ) ] );
		$etudiant->setParcours( $ligne[ $this->structureMoyenne->getIndiceColonne( "cursus" ) ] );
		$etudiant->setPromotion( $this->promotion );
		$etudiant->setIdEtude( -1 ); //FIXME: à modifier
		return $etudiant;
	}

	private function creerEtude( array $ligne ) : Etude
	{
		$etude = new Etude( );
		$etude->setSpecialite( $ligne[ $this->structureMoyenne->getIndiceColonne( "specialite" ) ] ?? "" );
		$etude->setTypeBac( $ligne[ $this->structureMoyenne->getIndiceColonne( "typeBAC" ) ] ?? "" );
		return $etude;
	}

	private function creerSemestre( ) : Semestre
	{
		$semestre = new Semestre( );
		$semestre->setNumSemestre( $this->semestre );
		return $semestre;
	}

	private function creerEtudiantSemestre( array $ligne ) : EtudiantSemestre
	{
		$etudiantSemestre = new EtudiantSemestre( );
		$etudiantSemestre->setCodeNIP( $ligne[ $this->structureMoyenne->getIndiceColonne( "codeNIP" ) ] );
		$etudiantSemestre->setNumSemestre( $this->semestre );

		$etudiantSemestre->setPassage( "erreur" ); //Cet attribut est modifié avec le fichier Jury
		$etudiantSemestre->setRang( $ligne[ $this->structureMoyenne->getIndiceColonne( "rang" ) ] );

		$nbAbsencesTotal = $ligne[ $this->structureMoyenne->getIndiceColonne( "absTotal" ) ];
		$nbAbsencesJust = $ligne[ $this->structureMoyenne->getIndiceColonne( "absJust" ) ];
		$etudiantSemestre->setNbAbsences( $nbAbsencesTotal - $nbAbsencesJust );

		return $etudiantSemestre;
	}

	private function creerCursus( string $codeNIP, string $idCompetence ) : Cursus
	{
		$cursus = new Cursus( );
		$cursus->setCodeNIP( $codeNIP );
		$cursus->setNumSemestre( $this->semestre );
		$cursus->setIdCompetence( $idCompetence );
		$cursus->setAnnee( $this->promotion );
		$cursus->setAdmission( "nonaffectee" ); //REMARQUE : Cet attribut est modifié par la suite avec le fichier Jury
		return $cursus;
	}

	private function creerEstNote( array $ligneMoyenne, string $codeNIP, string $nomMatiere, float $moyenne ) : EstNote
	{
		$estNote = new EstNote( );
		$estNote->setCodeNIP( $codeNIP );
		$estNote->setIdMatiere( $nomMatiere );
		$estNote->setMoyenne( $moyenne );
		return $estNote;
	}

	private function creerCompetence( string $nomCompetence ) : Competence
	{
		$competence = new Competence( );
		$competence->setIdCompetence( $nomCompetence );
		$competence->setAnnee( $this->promotion );
		return $competence;
	}

	private function creerMatiere( string $nomMatiere ) : Matiere
	{
		$matiere = new Matiere( );
		$matiere->setIdMatiere( $nomMatiere );
		$matiere->setAlternant( $this->enAlternance );
		return $matiere;
	}

	private function creerCompetenceMatiere( string $idCompetence, string $idMatiere ) : CompetenceMatiere
	{
		$competenceMatiere = new CompetenceMatiere( );
		$competenceMatiere->setIdCompetence( $idCompetence );
		$competenceMatiere->setAnnee( $this->promotion );
		$competenceMatiere->setIdMatiere( $idMatiere );
		return $competenceMatiere;
	}
}
?>