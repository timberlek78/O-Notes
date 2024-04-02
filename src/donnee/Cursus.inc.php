<?php
class Cursus
{
	//clé primaire
	private int     $codeNIP;
	private int     $numSemestre;
	private string  $idCompetence;
	private string  $annee;
	private ?string $admission;

	public function __construct( int $codeNIP=-1, int $numsemestre=-1, int $numcompt=-1, string $admission="" )
	{
		$this->codeNIP  = $codeNIP;
		$this->numsemestre  = $numsemestre;
		$this->numcompt= $numcompt;
		$this->admission   = $admission;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getCodeNIP(): int
	{
		return $this->codeNIP;
	}

	public function getNumSemestre(): int
	{
		return $this->numSemestre;
	}

	public function getIdCompetence(): string
	{
		return $this->idCompetence;
	}

	public function getAdmission(): string
	{
		return $this->admission;
	}

	public function getAnnee() : string 
	{
		return $this->annee;
	}

	public function setCodeNIP( int $codeNIP )
	{
		$this->codeNIP = $codeNIP;
	}

	public function setNumSemestre( int $numSemestre )
	{
		$this->numSemestre = $numSemestre;
	}

	public function setIdCompetence( int $idCompetence )
	{
		$this->idCompetence = $idCompetence;
	}

	public function setAdmission( string $admission ): void
	{
		$this->admission = $admission;
	}

	public function setAnnne(string $annee)
	{
		$this->annee = $annee;
	}
}
?>