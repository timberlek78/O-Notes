<?php
class EtudiantSemestre 
{
	//clé primaire
	private int $idetudiant;
	private int $numsemestre;

	//attributs
	private ?string $passage;
	private ?int $rang;
	private ?int $nbabsences;

	public function __construct( int $idetudiant=-1, int $numsemestre=-1, string $passage="", int $rang=-1, int $nbabsences=-1 )
	{
		$this->idetudiant = $idetudiant;
		$this->numsemestre = $numsemestre;
		$this->passage    = $passage;
		$this->rang       = $rang;
		$this->nbabsences = $nbabsences;
	}

	public function getId(): int
	{
		return $this->idetudiant;
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

	public function setidetudiant( int $idetudiant ): void
	{
		$this->idetudiant = $idetudiant;
	}

	public function setnumsemestre( int $numsemestre ): void
	{
		$this->numsemestre = $numsemestre;
	}

	public function setPassage( string $passage ): void
	{
		$this->passage = $passage;
	}

	public function setRang( int $rang ): void
	{
		$this->rang = $rang;
	}

	public function setnbabsences( int $nbabsences ): void
	{
		$this->nbabsences = $nbabsences;
	}
}
?>