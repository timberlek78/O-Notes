<?php
class Cursus
{
	//clé primaire
	private string  $codenip;
	private int     $numsemestre;
	private string  $idcompetence;
	private string  $annee;
	private ?string $admission;

	public function __construct( string $codenip="", int $numsemestre=-1, string $idcompetence="", string $annee="", string $admission="" )
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
		return $this->codenip;
	}

	public function getNumSemestre(): int
	{
		return $this->numsemestre;
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

	public function setCodeNIP( string $codeNIP )
	{
		$this->codenip = $codeNIP;
	}

	public function setNumSemestre( int $numSemestre )
	{
		$this->numsemestre = $numSemestre;
	}

	public function setIdCompetence( string $idCompetence )
	{
		$this->idcompetence = $idCompetence;
	}

	public function setAdmission( string $admission ): void
	{
		$this->admission = $admission;
	}

	public function setAnnee(string $annee)
	{
		$this->annee = $annee;
	}

	public function __toString( ): string
	{
		return "Cursus : codenip=$this->codenip, numsemestre=$this->numsemestre, idcompetence=$this->idcompetence, annee=$this->annee, admission=$this->admission";
	}
}
?>