<?php
class CompetenceMatiere
{
	//clé primaire
	private int $numcompt;
	private int $nummatiere;

	public function __construct( int $numcompt=-1, int $nummatiere=-1 )
	{
		$this->numcompt = $numcompt;
		$this->nummatiere    = $nummatiere;
	}

	public function getId(): int
	{
		return $this->numcompt;
	}

	public function getNumMatiere(): int
	{
		return $this->nummatiere;
	}

	private function setNumCompt( int $numcompt ): void
	{
		$this->numcompt = $numcompt;
	}

	private function setNumMatiere( int $nummatiere ): void
	{
		$this->nummatiere = $nummatiere;
	}
}
?>