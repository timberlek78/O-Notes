<?php
class CompetenceMatiere
{
	//clé primaire
	private string $idcompetence;
	private string $annee;
	private string $idmatiere;

	public function __construct( string $idCompetence="", string $annee ="",string $idMatiere="" )
	{
		$this->idcompetence = $idCompetence;
		$this->annee        = $annee;
		$this->idmatiere   = $idMatiere;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getIdCompetence(): string
	{
		return $this->idcompetence;
	}

	public function getIdMatiere(): string
	{
		return $this->idmatiere;
	}

	public function getAnnee(): string
	{
		return $this->annee;
	}

	public function setIdCompetence( string $idCompetence )
	{
		$this->idcompetence = $idCompetence;
	}

	public function setAnnee( string $annee )
	{
		$this->annee = $annee;
	}

	public function setIdMatiere( string $idMatiere )
	{
		$this->idmatiere = $idMatiere;
	}

	public function __toString(): string
	{
		return "CompetenceMatiere : idcompetence = ".$this->idcompetence.", annee = ".$this->annee.", idmatiere = ".$this->idmatiere;
	}
}
?>