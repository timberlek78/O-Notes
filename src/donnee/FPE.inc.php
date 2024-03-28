<?php
class FPE
{
	//clé primaire
	private int $id;

	//attributs
	private string $nomDirecteur;
	private int $anneePromo;

	public function __construct( string $nomDirecteur, int $anneePromo )
	{
		$this->nomDirecteur = $nomDirecteur;
		$this->anneePromo   = $anneePromo;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getNomDirecteur(): string
	{
		return $this->nomDirecteur;
	}

	public function getAnneePromo(): int
	{
		return $this->anneePromo;
	}

	private function setId( int $id ): void
	{
		$this->id = $id;
	}

	public function setNomDirecteur( string $nomDirecteur ): void
	{
		$this->nomDirecteur = $nomDirecteur;
	}

	public function setAnneePromo( int $anneePromo ): void
	{
		$this->anneePromo = $anneePromo;
	}
}
?>