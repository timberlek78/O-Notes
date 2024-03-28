<?php
class Etude
{
	//clé primaire
	private int $id;

	//attributs
	private string $specialite;
	private string $typeBac;

	//clé étrangère
	private int $idEtudiant;

	public function __construct( string $specialite, string $typeBac, int $idEtudiant )
	{
		$this->specialite = $specialite;
		$this->typeBac    = $typeBac;
		$this->idEtudiant = $idEtudiant;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getSpecialite(): string
	{
		return $this->specialite;
	}

	public function getTypeBac(): string
	{
		return $this->typeBac;
	}

	public function getIdEtudiant(): int
	{
		return $this->idEtudiant;
	}

	private function setId( int $id ): void
	{
		$this->id = $id;
	}

	public function setSpecialite( string $specialite ): void
	{
		$this->specialite = $specialite;
	}

	public function setTypeBac( string $typeBac ): void
	{
		$this->typeBac = $typeBac;
	}

	public function setIdEtudiant( int $idEtudiant ): void
	{
		$this->idEtudiant = $idEtudiant;
	}
}
?>