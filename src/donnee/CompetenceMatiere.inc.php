<?php
class CompetenceMatiere
{
	//clé primaire
	private string $idCompetence;
	private string $annee;
	private string $idMatiere;

	public function __construct( string $idCompetence="", string $annee ="",string $idMatiere="" )
	{
		$this->idCompetence = $idCompetence;
		$this->annee        = $annee;
		$this->idMatiere   = $idMatiere;
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

	private function setidCompetence( string $idCompetence )
	{
		$this->idCompetence = $idCompetence;
	}

	private function setNumMatiere( string $idMatiere )
	{
		$this->idMatiere = $idMatiere;
	}
}
?>