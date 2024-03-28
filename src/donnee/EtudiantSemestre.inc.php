<?php
class EtudiantSemestre
{
	//clé primaire
	private int $idEtudiant;
	private int $idSemestre;

	//attributs
	private ?string $passage;
	private ?int $rang;
	private ?int $nbAbsences;

	public function __construct( int $idEtudiant=-1, int $idSemestre=-1, string $passage="", int $rang=-1, int $nbAbsences=-1 )
	{
		$this->idEtudiant = $idEtudiant;
		$this->idSemestre = $idSemestre;
		$this->passage    = $passage;
		$this->rang       = $rang;
		$this->nbAbsences = $nbAbsences;
	}

	public function getIdEtudiant(): int
	{
		return $this->idEtudiant;
	}

	public function getIdSemestre(): int
	{
		return $this->idSemestre;
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
		return $this->nbAbsences;
	}

	public function setIdEtudiant( int $idEtudiant ): void
	{
		$this->idEtudiant = $idEtudiant;
	}

	public function setIdSemestre( int $idSemestre ): void
	{
		$this->idSemestre = $idSemestre;
	}

	public function setPassage( string $passage ): void
	{
		$this->passage = $passage;
	}

	public function setRang( int $rang ): void
	{
		$this->rang = $rang;
	}

	public function setNbAbsences( int $nbAbsences ): void
	{
		$this->nbAbsences = $nbAbsences;
	}
}
?>