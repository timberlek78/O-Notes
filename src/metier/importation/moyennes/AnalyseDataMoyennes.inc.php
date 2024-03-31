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

	//METODE DE TEST
	public function analyserCompetences( )
	{
		$ensNomCompetence = $this->structure->getCompetences( $this->semestre );
		echo "Competences : <br>";
		foreach( $ensNomCompetence as $nomCompetence )
		{
			$competence = $this->creerCompetence( $nomCompetence );
			echo $competence;
			echo "<br>";

			$ensNomMatiere = $this->structure->getRessourcesCompetence( $nomCompetence );
			echo "<ul>Matieres : <br>";
			foreach( $ensNomMatiere as $nomMatiere )
			{
				$matiere = $this->creerMatiere( $nomMatiere );
				$competenceMatiere = $this->creerCompetenceMatiere( );

				echo "<li style=\"color:blue\">".$matiere."</li>";
				echo "<li style=\"color:red\">".$competenceMatiere."</li>";
			}
			echo "</ul>";
		}
		echo "<br>";
	}

	//METHODE DE TEST
	public function analyserEtudiants( )
	{
		for( $cptEtudiant = 1; $cptEtudiant < count( $this->tableau ); $cptEtudiant++ )
		{
			$ligne = $this->tableau[ $cptEtudiant ];
			$etudiant = $this->creerEtudiant( $ligne );
			echo $etudiant;
			echo "<br>";

			$etude = $this->creerEtude( $ligne );
			echo $etude;
			echo "<br>";

			$semestre = $this->creerSemestre( $ligne );
			echo $semestre;
			echo "<br>";

			$etudiantSemestre = $this->creerEtudiantSemestre( $ligne );
			echo $etudiantSemestre;
			echo "<br>";

			$cursus = $this->creerCursus( $ligne );
			echo $cursus;
			echo "<br>";

			echo "---<br>";
		}
	}

	private function creerEtudiant( array $ligne ) : Etudiant
	{
		$etudiant = new Etudiant( );
		$etudiant->setcodenip( $ligne[ $this->structure->getIndiceColonne( "codeNIP" ) ] );
		$etudiant->setNom( $ligne[ $this->structure->getIndiceColonne( "nom" ) ] );
		$etudiant->setPrenom( $ligne[ $this->structure->getIndiceColonne( "prenom" ) ] );
		$etudiant->setParcours( $ligne[ $this->structure->getIndiceColonne( "cursus" ) ] );
		$etudiant->setPromotion( $this->promotion );
		return $etudiant;
	}

	private function creerEtude( array $ligne ) : Etude
	{
		$etude = new Etude( );
		$etude->setSpecialite( $ligne[ $this->structure->getIndiceColonne( "specialite" ) ] ?? "" );
		$etude->setTypeBac( $ligne[ $this->structure->getIndiceColonne( "typeBAC" ) ] ?? "" );
		$etude->setIdEtudiant( -1 ); //FIXME: à modifier
		return $etude;
	}

	private function creerSemestre( array $ligne ) : Semestre
	{
		$semestre = new Semestre( );
		$semestre->setnumsemestre( $this->semestre );
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
		return $matiere;
	}

	private function creerCompetenceMatiere( ) : CompetenceMatiere
	{
		$competenceMatiere = new CompetenceMatiere( );
		$competenceMatiere->setNumCompt( -1 ); //FIXME: à modifier
		$competenceMatiere->setNumMatiere( -1 ); //FIXME: à modifier
		return $competenceMatiere;
	}
}
?>