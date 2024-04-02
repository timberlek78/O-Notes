<?php
class EtudiantSemestre 
{
	//clé primaire
	private int $codeNIP;
	private int $numSemestre;

	//attributs
	private ?string $passage;
	private ?int $rang;
	private ?int $nbabsences;

	public function __construct( int $codeNIP=-1, int $numsemestre=-1, string $passage="", int $rang=-1, int $nbabsences=-1 )
	{
		$this->codeNIP     = $codeNIP;
		$this->numsemestre = $numsemestre;
		$this->passage     = $passage;
		$this->rang        = $rang;
		$this->nbabsences  = $nbabsences;
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
		$this->codeNIP = $codeNIP;
	}

	public function setnumsemestre( int $numSemestre )
	{
		$this->numSemestre = $numSemestre;
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
		return "EtudiantSemestre : idetudiant=$this->idetudiant, numsemestre=$this->numsemestre, passage=$this->passage, rang=$this->rang, nbabsences=$this->nbabsences";
	}
}
?>