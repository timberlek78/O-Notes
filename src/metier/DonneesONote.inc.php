<?php
class DonneesONote
{
	public array $ensCompetence;
	public array $ensCompetenceMatiere;
	public array $ensCursus;
	public array $ensEstNote;
	public array $ensEtude;
	public array $ensEtudiant;
	public array $ensEtudiantSemestre;
	public array $ensMatiere;
	public Semestre $semestre;

	public function __construct()
	{
		$this->ensCompetence        = array();
		$this->ensCompetenceMatiere = array();
		$this->ensCursus            = array();
		$this->ensEstNote           = array();
		$this->ensEtude             = array();
		$this->ensEtudiant          = array();
		$this->ensEtudiantSemestre  = array();
		$this->ensMatiere           = array();
		$this->semestre             = new Semestre();
	}

	

	public function __toString( ) : string
	{
		$str = "DonneesONote du semestre : ".$this->semestre."<br>";
		$str .= $this->competencesToString( );
		$str .= "<br>";
		$str .= $this->etudiantsToString( );
		return $str;
	}

	private function competencesToString( ) : string
	{
		$str = "Competences : <br>";
		foreach( $this->ensCompetence as $competence )
		{
			$str .= $competence;
			$str .= "<br>";

			$str .= "<ul>Matieres : <br>";
			$cptMatiere = 0;
			foreach( $this->ensMatiere as $matiere )
			{
				$competenceMatiere = $this->ensCompetenceMatiere[ $cptMatiere ];
				if( $competenceMatiere->getIdCompetence( ) == $competence->getIdCompetence( ) )
				{
					$str .= "<li style=\"color:blue\">".$matiere."</li>";
					$str .= "<li style=\"color:red\">" . $competenceMatiere . "</li>";
				}
				$cptMatiere++;
			}
			$str .= "</ul>";
		}
		$str .= "<br>";
		return $str;
	}

	private function etudiantsToString( ) : string
	{
		$str = "Etudiants : <br>";
		for( $cptEtudiant = 0; $cptEtudiant < count( $this->ensEtudiant ); $cptEtudiant++ )
		{
			$str .= $this->ensEtudiant[ $cptEtudiant ];
			$str .= "<br>";

			$str .= "<ul>";
			$str .= "<li style='color:gray'>" . $this->ensEtude[ $cptEtudiant ] . "</li>";
			$str .= "<li style='color:gray'>" . $this->ensEtudiantSemestre[ $cptEtudiant ] . "</li>";

			for( $cptCursus = 0; $cptCursus < count( $this->ensCursus ); $cptCursus++ )
			{
				$cursus = $this->ensCursus[ $cptCursus ];
				if( $cursus->getCodeNIP( ) == $this->ensEtudiant[ $cptEtudiant ]->getCodeNIP( ) )
				{
					$str .= "<li>" . $cursus . "</li>";
				}
			}
			$str .= "</ul>";

			$str .= "<ul>";
			for( $cptNote = 0; $cptNote < count( $this->ensEstNote ); $cptNote++ )
			{
				$note = $this->ensEstNote[ $cptNote ];
				if( $note->getCodeNIP( ) == $this->ensEtudiant[ $cptEtudiant ]->getCodeNIP( ) )
				{
					$str .= "<li>" . $note . "</li>";
				}
			}
			$str .= "</ul>";
		}
		return $str;
	}
}
?>