<?php
class Cursus
{
	//clé primaire
	private int     $idetudiant;
	private int     $numsemestre;
	private int     $numcompt;
	private ?string $admission;

	public function __construct( int $idetudiant=-1, int $numsemestre=-1, int $numcompt=-1, string $admission="" )
	{
		$this->idetudiant  = $idetudiant;
		$this->numsemestre  = $numsemestre;
		$this->numcompt= $numcompt;
		$this->admission   = $admission;
	}

	public function getId(): int
	{
		return $this->idetudiant;
	}

	public function getNumSemestre(): int
	{
		return $this->numsemestre;
	}

	public function getNumCompt(): int
	{
		return $this->numcompt;
	}

	public function getAdmission(): string
	{
		return $this->admission;
	}

	public function setIdEtudiant( int $idetudiant ): void
	{
		$this->idetudiant = $idetudiant;
	}

	public function setNumSemestre( int $numsemestre ): void
	{
		$this->numsemestre = $numsemestre;
	}

	public function setNumCompt( int $numcompt ): void
	{
		$this->numcompt = $numcompt;
	}

	public function setAdmission( string $admission ): void
	{
		$this->admission = $admission;
	}
}
?>