<?php

require_once 'AnalyseStructureMoyennes.inc.php';
require_once __DIR__.'/../../../donnee/IncludeAll.php';

class AnalyseDataMoyennes
{
	private array $tableau;
	private AnalyseStructureMoyennes $structure;

	private string $promotion;
	private int    $semestre;
	private bool   $enAlternance;

	public function __construct( array $tableau, string $promotion, int $semestre, bool $enAlternance )
	{
		$this->tableau = $tableau;
		$this->structure = new AnalyseStructureMoyennes( $this->tableau[ 0 ], $semestre );
		
		$this->promotion    = $promotion;
		$this->semestre     = $semestre;
		$this->enAlternance = $enAlternance;
	}

	public function ajouterCompetencesDansDonnees( DonneesONote $donnes )
	{
		$semestre = $this->creerSemestre( );
		$donnes->semestre = $semestre;

		$ensNomCompetence = $this->structure->getCompetences( $this->semestre );
		foreach( $ensNomCompetence as $nomCompetence )
		{
			$competence = $this->creerCompetence( $nomCompetence );
			$donnes->ensCompetence[] = $competence;

			$ensNomMatiere = $this->structure->getRessourcesCompetence( $nomCompetence );
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
		for( $cptEtudiant = 1; $cptEtudiant < count( $this->tableau ); $cptEtudiant++ )
		{
			$ligne = $this->tableau[ $cptEtudiant ];

			$etudiant = $this->creerEtudiant( $ligne );
			$donnees->ensEtudiant[] = $etudiant;

			$etude = $this->creerEtude( $ligne );
			$donnees->ensEtude[] = $etude;

			$etudiantSemestre = $this->creerEtudiantSemestre( $ligne );
			$donnees->ensEtudiantSemestre[] = $etudiantSemestre;

			$this->ajouterCursusDansDonnees( $donnees, $etudiant->getCodeNIP( ) );
		}
	}

	private function ajouterCursusDansDonnees( DonneesONote $donnees, string $codeNIP )
	{
		$ensNomCompetence = $this->structure->getCompetences( $this->semestre );
		foreach( $ensNomCompetence as $nomCompetence )
		{
			$cursus = $this->creerCursus( $codeNIP, $nomCompetence );
			$donnees->ensCursus[] = $cursus;
		}
	}

	private function creerEtudiant( array $ligne ) : Etudiant
	{
		$etudiant = new Etudiant( );
		$etudiant->setCodeNIP( $ligne[ $this->structure->getIndiceColonne( "codeNIP" ) ] );
		$etudiant->setNom( $ligne[ $this->structure->getIndiceColonne( "nom" ) ] );
		$etudiant->setPrenom( $ligne[ $this->structure->getIndiceColonne( "prenom" ) ] );
		$etudiant->setParcours( $ligne[ $this->structure->getIndiceColonne( "cursus" ) ] );
		$etudiant->setPromotion( $this->promotion );
		$etudiant->setIdEtude( -1 ); //FIXME: à modifier
		return $etudiant;
	}

	private function creerEtude( array $ligne ) : Etude
	{
		$etude = new Etude( );
		$etude->setSpecialite( $ligne[ $this->structure->getIndiceColonne( "specialite" ) ] ?? "" );
		$etude->setTypeBac( $ligne[ $this->structure->getIndiceColonne( "typeBAC" ) ] ?? "" );
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
		$etudiantSemestre->setCodeNIP( $ligne[ $this->structure->getIndiceColonne( "codeNIP" ) ] );
		$etudiantSemestre->setNumSemestre( $this->semestre );

		$etudiantSemestre->setPassage( "todo" ); //FIXME: à modifier
		$etudiantSemestre->setRang( $ligne[ $this->structure->getIndiceColonne( "rang" ) ] );

		$nbAbsencesTotal = $ligne[ $this->structure->getIndiceColonne( "absTotal" ) ];
		$nbAbsencesJust = $ligne[ $this->structure->getIndiceColonne( "absJust" ) ];
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
		$cursus->setAdmission( "todo" ); //FIXME: à modifier
		return $cursus;
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
		$competenceMatiere->setIdCompetence( $idCompetence ); //TODO: à verifier
		$competenceMatiere->setAnnee( $this->promotion );
		$competenceMatiere->setIdMatiere( $idMatiere ); //TODO: à verifier
		return $competenceMatiere;
	}
}
?>