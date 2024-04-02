<?php
class FPE
{
	//clé primaire
	private int $idfpe;

	//attributs
	private ?string $nomdirecteur;
	private ?int    $anneepromodebut;
	private ?int    $anneepromofin;

	public function __construct( string $nomdirecteur="", int $anneepromodebut=-1, int $anneepromofin=-1 )
	{
		$this->nomdirecteur    = $nomdirecteur;
		$this->anneepromodebut = $anneepromodebut;
		$this->anneepromofin   = $anneepromofin;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getId(): int
	{
		return $this->idfpe;
	}

	public function getNomDirecteur(): string
	{
		return $this->nomdirecteur;
	}

	public function getAnneePromoDebut(): int
	{
		return $this->anneepromodebut;
	}

	public function getAnneePromoFin(): int
	{
		return $this->anneepromofin;
	}

	public function setIdFpe( int $idfpe ): void
	{
		$this->idfpe = $idfpe;
	}

	public function setNomDirecteur( string $nomdirecteur ): void
	{
		$this->nomdirecteur = $nomdirecteur;
	}

	public function setAnneePromoDebut( int $anneepromodebut ): void
	{
		$this->anneepromodebut = $anneepromodebut;
	}

	public function setAnneePromoFin( int $anneepromofin ): void
	{
		$this->anneepromofin = $anneepromofin;
	}
}
?>