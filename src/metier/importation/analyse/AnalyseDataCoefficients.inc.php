<?php
class AnalyseDataCoefficients
{
	//Description générale du fichier
	public static int $COL_DESCRIPTION_COMPETENCE = 1;
	public static int $COL_COEF_COMPETENCES = 3;
	public static int $COL_SEMESTRE = 1;
	public static int $COL_MATIERE = 0;

	//Attributs constructeur
	private array $tableauCoef;
	private string $annee;
	private int $nbSemestre;
	private bool $alternance;

	//Attributs
	private int $ligneActuelle;
	private int $nbCompetence;

	function __construct( array $tableauCoef, string $annee, int $nbSemestre, bool $alternance )
	{
		$this->tableauCoef = $tableauCoef;
		$this->annee = $annee;
		$this->nbSemestre = $nbSemestre;
		$this->alternance = $alternance;

		$this->ligneActuelle = 0;
	}

	public function completer ( DonneesONote $donnees )
	{
		$this->creerCompetences( $donnees );
		$this->creerSemestres( $donnees );
	}

	private function creerCompetences ( DonneesONote $donnees )
	{
		$this->ligneActuelle++;
		$colonne = AnalyseDataCoefficients::$COL_DESCRIPTION_COMPETENCE;

		$cptCompetence = 1;
		$regex = "/^UE \d./";
		while ( preg_match_all( $regex, $this->tableauCoef[ $this->ligneActuelle ][ $colonne ] . "" ) )
		{
			for( $cptSemestre = 1; $cptSemestre <= $this->nbSemestre; $cptSemestre++)
			{
				$donnees->ensCompetence[] = new Competence( "BIN" . $cptSemestre . $cptCompetence, $this->annee );
			}
			
			$cptCompetence++;
			$this->ligneActuelle++;
		}
		$this->nbCompetence = $cptCompetence;
	}

	private function creerSemestres ( DonneesONote $donnees )
	{
		$semestreActuel = 0;

		$this->ligneActuelle++;
		$colonne = AnalyseDataCoefficients::$COL_SEMESTRE;

		$cptSemestre = 1;
		while ( $this->ligneActuelle < count( $this->tableauCoef ) )
		{
			$regex = "/^Semestre \d/";
			if ( preg_match_all( $regex, $this->tableauCoef[ $this->ligneActuelle ][ $colonne ] . "" ) )
			{
				$semestreActuel = $cptSemestre;
				$cptSemestre++;
			}

			$this->creerMatiere ( $donnees, $semestreActuel );

			$this->ligneActuelle++;
		}
	}

	private function creerMatiere ( DonneesONote $donnees, int $semestre )
	{
		$colonne = AnalyseDataCoefficients::$COL_MATIERE;

		$nomMatiere = $this->tableauCoef[ $this->ligneActuelle ][ $colonne ] . "";

		$regex = "/^BIN[RSP]" . $semestre . "\d\d$/";
		$estRessource = preg_match_all( $regex, $nomMatiere );

		if ( $estRessource )
		{
			$alternance = $semestre >= 5;
			if( $alternance )
			{
				$donnees->ensMatiere[] = new Matiere( $nomMatiere . 'A', $this->alternance );
			}

			$donnees->ensMatiere[] = new Matiere( $nomMatiere, $this->alternance );

			$this->creerCompetenceMatiere( $donnees, $semestre, $nomMatiere );
		}

	}
	
	private function creerCompetenceMatiere( DonneesONote $donnees, int $semestre, string $nomMatiere )
	{
		$colonne = AnalyseDataCoefficients::$COL_COEF_COMPETENCES;
		for( $cptCompetence=1; $cptCompetence <= $this->nbCompetence; $cptCompetence++ )
		{
			$coef = $this->tableauCoef[ $this->ligneActuelle ][ $colonne + $cptCompetence-1 ];
			$coefEstRenseigne = ( $coef != "" && !is_null( $coef ) );
			if( $coefEstRenseigne )
			{
				$donnees->ensCompetenceMatiere[] = new CompetenceMatiere( "BIN" . $semestre . $cptCompetence, $this->annee, $nomMatiere, doubleval($coef) );
			}
		}
	}
}
?>