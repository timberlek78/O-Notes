<?php
class Competence
{
	//clé primaire
	private int $id;

	//attributs
	private ?string $libelle;

	public function __construct( string $libelle="" )
	{
		$this->libelle = $libelle;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getLibelle(): string
	{
		return $this->libelle;
	}

	private function setId( int $id ): void
	{
		$this->id = $id;
	}

	public function setLibelle( string $libelle ): void
	{
		$this->libelle = $libelle;
	}

	public function __toString(): string
	{
		return "Competence : libelle = ".$this->libelle;
	}
}
?>