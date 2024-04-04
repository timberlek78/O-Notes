<?php
class EtudiantSemestre 
{
	//clé primaire
	private int $codenip;
	private int $numsemestre;

	//attributs
	private ?string $passage;
	private ?int $rang;
	private ?int $nbabs;

	public function __construct( int $codeNIP=-1, int $numSemestre=-1, string $passage="", int $rang=-1, int $nbAbsences=-1 )
	{
		$this->codenip     = $codeNIP;
		$this->numsemestre = $numSemestre;
		$this->passage     = $passage;
		$this->rang        = $rang;
		$this->nbabs       = $nbAbsences;
	}

	public function getEqClesPrimaires( ) : array
	{
		return array( "codenip"     => $this->codenip,
					  "numsemestre" => $this->numsemestre );
	}

	public function getEqAttributs() : array
	{
		return array( "codenip"     => $this->codenip,
					  "numsemestre" => $this->numsemestre,
					  "passage"     => $this->passage,
					  "rang"        => $this->rang,
					  "nbabs"       => $this->nbabs);
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
		return $this->nbabs;
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
		$this->nbabs = $nbabsences;
	}

	public function __toString(): string
	{
		return "EtudiantSemestre : codenip=$this->codenip, numsemestre=$this->numsemestre, passage=$this->passage, rang=$this->rang, nbabsences=$this->nbabs";
	}

	public function equals( EtudiantSemestre $etudiantSemestre ): bool
	{
		return ( $this->codenip == $etudiantSemestre->codenip && $this->numsemestre == $etudiantSemestre->numsemestre );
	}
}
?>