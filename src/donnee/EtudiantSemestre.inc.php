<?php
class EtudiantSemestre 
{
	//clé primaire
	private int $codenip;
	private int $numsemestre;

	//attributs
	private ?string $passage;
	private ?int $rang;
	private ?int $nbabsences;

	public function __construct( int $codeNIP=-1, int $numSemestre=-1, string $passage="", int $rang=-1, int $nbAbsences=-1 )
	{
		$this->codenip     = $codeNIP;
		$this->numsemestre = $numSemestre;
		$this->passage     = $passage;
		$this->rang        = $rang;
		$this->nbabsences  = $nbAbsences;
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

	public function getPassage(): string
	{
		return $this->passage;
	}

	public function getRang(): int
	{
		return $this->rang;
	}

	public function getNbAbsences(): int
	{
		return $this->nbabsences;
	}

	public function setCodeNIP( int $codeNIP )
	{
		$this->codenip = $codeNIP;
	}

	public function setnumsemestre( int $numSemestre )
	{
		$this->numsemestre = $numSemestre;
	}

	public function setPassage( string $passage )
	{
		$this->passage = $passage;
	}

	public function setRang( int $rang )
	{
		$this->rang = $rang;
	}

	public function setnbabsences( int $nbabsences )
	{
		$this->nbabsences = $nbabsences;
	}

	public function __toString(): string
	{
		return "EtudiantSemestre : codenip=$this->codenip, numsemestre=$this->numsemestre, passage=$this->passage, rang=$this->rang, nbabsences=$this->nbabsences";
	}
}
?>