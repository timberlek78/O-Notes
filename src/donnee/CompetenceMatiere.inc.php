<?php
class CompetenceMatiere
{
	//clé primaire
	private string $idCompetence;
	private string $annee;
	private string $idMatiere;
	private int    $coeff;

	public function __construct( string $idCompetence="", string $annee ="",string $idMatiere="", int $coeff)
	{
		$this->idCompetence = $idCompetence;
		$this->annee        = $annee;
		$this->idMatiere   = $idMatiere;
		$this->coeff       = $coeff;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getidCompetence(): string
	{
		return $this->idCompetence;
	}

	public function getidMatiere(): string
	{
		return $this->idMatiere;
	}

	public function getCoeff(): int
	{
		return $this->coeff;
	}


	private function setidCompetence( string $idCompetence )
	{
		$this->idCompetence = $idCompetence;
	}

	private function setNumMatiere( string $idMatiere )
	{
		$this->idMatiere = $idMatiere;
	}

	private function setCoeff( int $coeff )
	{
		$this->coeff = $coeff;
	}
}
?>