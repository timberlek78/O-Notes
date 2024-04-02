<?php
class Cursus
{
	//clé primaire
	private int     $codeNIP;
	private int     $numSemestre;
	private string  $idCompetence;
	private string  $annee;
	private ?string $admission;

	public function __construct( int $idetudiant=-1, int $numsemestre=-1, int $numcompt=-1, string $admission="" )
	{
		$this->idetudiant  = $idetudiant;
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

	public function getidCompetence(): string
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

	public function setidCompetence( int $idCompetence )
	{
		$this->idCompetence = $idCompetence;
	}

	public function setAdmission( string $admission ): void
	{
		$this->admission = $admission;
	}

	public function __toString( ): string
	{
		return "Cursus : idetudiant=$this->idetudiant, numsemestre=$this->numsemestre, numcompt=$this->numcompt, admission=$this->admission";
	}
	
	public function setAnnne(string $annee)
	{
		$this->annee = $annee;
	}
}
?>