<?php
class DonneesONote
{
	public array $ensCompetence;
	public array $ensCompetenceMatiere;
	public array $ensCursus;
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
				$str .= "<li style=\"color:blue\">".$matiere."</li>";
				$str .= "<li style=\"color:red\">".$this->ensCompetenceMatiere[ $cptMatiere ]."</li>";
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

			$str .= $this->ensEtude[ $cptEtudiant ];
			$str .= "<br>";

			$str .= $this->ensEtudiantSemestre[ $cptEtudiant ];
			$str .= "<br>";

			$str .= $this->ensCursus[ $cptEtudiant ];
			$str .= "<br>";
		}
		return $str;
	}
}
?>