<?php
class CompetenceMatiere
{
	//clé primaire
	private int $idCompetence;
	private int $idMatiere;

	public function __construct( int $idCompetence, int $idMatiere )
	{
		$this->idCompetence = $idCompetence;
		$this->idMatiere    = $idMatiere;
	}

	public function getIdCompetence(): int
	{
		return $this->idCompetence;
	}

	public function getIdMatiere(): int
	{
		return $this->idMatiere;
	}

	private function setIdCompetence( int $idCompetence ): void
	{
		$this->idCompetence = $idCompetence;
	}

	private function setIdMatiere( int $idMatiere ): void
	{
		$this->idMatiere = $idMatiere;
	}
}
?>