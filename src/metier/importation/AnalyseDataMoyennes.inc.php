<?php
//string $promotion, int $semestre, bool $enAlternance
class AnalyseDataMoyennes
{
	private array $tableau;
	private AnalyseStructureMoyennes $structure;

	private string $promotion;
	private int    $semestre;
	private bool   $enAlternance;

	__construct( string $nomFichier, string $promotion, int $semestre, bool $enAlternance )
	{
		$excel = new LectureExcel( $nomFichier );
		$this->tableau = $excel->recupererDonnees( );
		$this->structure = new AnalyseStructureMoyennes( $this->tableau[ 0 ], $semestre );
		
		$this->promotion    = $promotion;
		$this->semestre     = $semestre;
		$this->enAlternance = $enAlternance;
	}

	public function analyser( )
	{
		/*$donnees = $this->tableau;
		$nbLignes = count( $donnees );

		$indDebut = $structure->getIndiceDebutCompetences( );
		$indFin   = $structure->getIndiceFinCompetences( );

		for( $i = 1; $i < $nbLignes; $i++ )
		{
			$ligne = $donnees[ $i ];
			$etudiant = $this->creerEtudiant( $ligne, $structure, $indDebut, $indFin );
			$etudiant->calculerMoyennes( $ligne, $structure );
		}*/
	}

	private function creerEtudiant( array $ligne ) : Etudiant
	{
		$etudiant = new Etudiant( );
		$etudiant->setNIP( $ligne[ $this->structure->getIndiceColonne( "codeNIP" ) ] );
		$etudiant->setNom( $ligne[ $this->structure->getIndiceColonne( "nom" ) ] );
		$etudiant->setPrenom( $ligne[ $this->structure->getIndiceColonne( "prenom" ) ] );
		$etudiant->setParcours( $ligne[ $this->structure->getIndiceColonne( "parcours" ) ] );
		$etudiant->setPromotion( $this->promotion );
		return $etudiant;
	}

	private function creerEtude( array $ligne ) : Etude
	{
		$etude = new Etude( );
		$etude->setSpecialite( $ligne[ $this->structure->getIndiceColonne( "specialite" ) ] );
		$etude->setTypeBac( $ligne[ $this->structure->getIndiceColonne( "typeBAC" ) ] );
		$etude->setIdEtudiant( -1 ); //FIXME: à modifier
		return $etude;
	}

	private function creerSemestre( array $ligne ) : Semestre
	{
		$semestre = new Semestre( );
		$semestre->setNumSemestre( $this->semestre );
		return $semestre;
	}

	private function creerEtudiantSemestre( array $ligne ) : EtudiantSemestre
	{
		$etudiantSemestre = new EtudiantSemestre( );
		$etudiantSemestre->setNumSemestre( -1 ); //FIXME: à modifier
		$etudiantSemestre->setPassage( -1 ); //FIXME: à modifier
		$etudiantSemestre->setRang( $ligne[ $this->structure->getIndiceColonne( "rang" ) ] );

		$nbAbsencesTotal = $ligne[ $this->structure->getIndiceColonne( "absTotal" ) ];
		$nbAbsencesJust = $ligne[ $this->structure->getIndiceColonne( "absJust" ) ];
		$etudiantSemestre->setNbAbsences( $nbAbsencesTotal - $nbAbsencesJust );

		return $etudiantSemestre;
	}

	//TODO: remarque : pour les fixme, il faudrait passer en paramètre l'objet nécessaire (étudiant, semestre etc)
	private function creerCursus( array $ligne ) : Cursus
	{
		$cursus = new Cursus( );
		$cursus->setIdEtudiant( -1 ); //FIXME: à modifier
		$cursus->setNumSemestre( -1 ); //FIXME: à modifier
		$cursus->setNumCompt( -1 ); //FIXME: à modifier
		$cursus->setAdmission( "admission" ); //FIXME: à modifier
		return $cursus;
	}

	private function creerCompetence( string $nomCompetence ) : Competence
	{
		return new Competence( $nomCompetence );
	}

	private function creerMatiere( string $nomMatiere ) : Matiere
	{
		$matiere = new Matiere( );
		$matiere->setAlternant( $this->enAlternance );
		$matiere->setLibelle( $nomMatiere );
	}

	private function creerCompetenceMatiere( ) : CompetenceMatiere
	{
		$competenceMatiere = new CompetenceMatiere( );
		$competenceMatiere->setNumCompt( -1 ); //FIXME: à modifier
		$competenceMatiere->setNumMatiere( -1 ); //FIXME: à modifier
	}
}
?>