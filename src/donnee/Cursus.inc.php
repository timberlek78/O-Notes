<?php
class Cursus
{
	//clé primaire
	private int    $idEtudiant;
	private int    $idSemestre;
	private int    $idCompetence;
	private string $admission;

	public function __construct( int $idEtudiant, int $idSemestre, int $idCompetence, string $admission )
	{
		$this->idEtudiant  = $idEtudiant;
		$this->idSemestre  = $idSemestre;
		$this->idCompetence= $idCompetence;
		$this->admission   = $admission;
	}

	public function getIdEtudiant(): int
	{
		return $this->idEtudiant;
	}

	public function getIdSemestre(): int
	{
		return $this->idSemestre;
	}

	public function getIdCompetence(): int
	{
		return $this->idCompetence;
	}

	public function getAdmission(): string
	{
		return $this->admission;
	}

	public function setIdEtudiant( int $idEtudiant ): void
	{
		$this->idEtudiant = $idEtudiant;
	}

	public function setIdSemestre( int $idSemestre ): void
	{
		$this->idSemestre = $idSemestre;
	}

	public function setIdCompetence( int $idCompetence ): void
	{
		$this->idCompetence = $idCompetence;
	}

	public function setAdmission( string $admission ): void
	{
		$this->admission = $admission;
	}
}
?>