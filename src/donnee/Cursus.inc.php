<?php
class Cursus
{
	//clé primaire
	private int     $codenip;
	private int     $numsemestre;
	private string  $idcompetence;
	private string  $annee;
	private ?string $admission;

	public function __construct( int $codeNIP=-1, int $numsemestre=-1, int $numcompt=-1, string $admission="" )
	{
		$this->codenip      = $codeNIP;
		$this->numsemestre  = $numsemestre;
		$this->numcompt     = $numcompt;
		$this->admission    = $admission;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getCodeNIP(): int
	{
		return $this->codenip;
	}

	public function getNumSemestre(): int
	{
		return $this->numsemestre;
	}

	public function getIdCompetence(): string
	{
		return $this->idcompetence;
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
		$this->codenip = $codeNIP;
	}

	public function setNumSemestre( int $numSemestre )
	{
		$this->numSemestre = $numSemestre;
	}

	public function setIdCompetence( int $idcompetence )
	{
		$this->idcompetence = $idcompetence;
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