<?php
class FPE
{
	//clé primaire
	private int $id;

	//attributs
	private string $nomDirecteur;
	private int $anneePromoDebut;
	private int $anneePromoFin;

	public function __construct( string $nomDirecteur, int $anneePromoDebut, int $anneePromoFin )
	{
		$this->nomDirecteur = $nomDirecteur;
		$this->anneePromoDebut = $anneePromoDebut;
		$this->anneePromoFin = $anneePromoFin;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getNomDirecteur(): string
	{
		return $this->nomDirecteur;
	}

	public function getAnneePromoDebut(): int
	{
		return $this->anneePromo;
	}

	public function getAnneePromoFin(): int
	{
		return $this->anneePromoFin;
	}

	private function setId( int $id ): void
	{
		$this->id = $id;
	}

	public function setNomDirecteur( string $nomDirecteur ): void
	{
		$this->nomDirecteur = $nomDirecteur;
	}

	public function setAnneePromoDebut( int $anneePromoDebut ): void
	{
		$this->anneePromoDebut = $anneePromoDebut;
	}

	public function setAnneePromoFin( int $anneePromoFin ): void
	{
		$this->anneePromoFin = $anneePromoFin;
	}
}
?>