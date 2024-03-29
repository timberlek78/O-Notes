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

	public function getIdFpe(): int
	{
		return $this->idfpe;
	}

	public function getNomDirecteur(): string
	{
		return $this->nomdirecteur;
	}

	public function getAnneePromoDebut(): int
	{
		return $this->anneePromo;
	}

	public function getAnneePromoFin(): int
	{
		return $this->anneepromofin;
	}

	private function setIdFpe( int $idfpe ): voidfpe
	{
		$this->idfpe = $idfpe;
	}

	public function setNomDirecteur( string $nomdirecteur ): voidfpe
	{
		$this->nomdirecteur = $nomdirecteur;
	}

	public function setAnneePromoDebut( int $anneepromodebut ): voidfpe
	{
		$this->anneepromodebut = $anneepromodebut;
	}

	public function setAnneePromoFin( int $anneepromofin ): voidfpe
	{
		$this->anneepromofin = $anneepromofin;
	}
}
?>