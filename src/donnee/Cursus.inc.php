<?php
class Cursus
{
	//clé primaire
	private int     $codenip;
	private int     $numsemestre;
	private string  $idcompetence;
	private string  $annee;
	private ?string $admission;

	public function __construct( int $codenip=-1, int $numsemestre=-1, string $idcompetence="", string $annee, string $admission="" )
	{
		$this->codenip      = $codenip;
		$this->numsemestre  = $numsemestre;
		$this->idcompetence = $idcompetence;
		$this->annee        = $annee;
		$this->admission    = $admission;
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

	public function getidCompetence(): string
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
		$this->codeNIP = $codeNIP;
	}

	public function setNumSemestre( int $numSemestre )
	{
		$this->numSemestre = $numSemestre;
	}

	public function setidCompetence( string $idCompetence )
	{
		$this->idCompetence = $idCompetence;
	}

	public function setAdmission( string $admission ): void
	{
		$this->admission = $admission;
	}

	public function setAnnee(string $annee)
	{
		$this->annee = $annee;
	}
}
?>