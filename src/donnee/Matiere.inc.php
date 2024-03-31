<?php
class Matiere
{
	//clé primaire
	private int $nummatiere;

	//attributs
	private ?float  $moyenne;
	private ?int    $coeff;
	private ?bool   $alternant;
	private ?string $libelle;

	public function __construct( float $moyenne=-1.0, int $coeff=-1, bool $alternant=false, string $libelle="" )
	{
		$this->moyenne   = $moyenne;
		$this->coeff     = $coeff;
		$this->alternant = $alternant;
		$this->libelle   = $libelle;
	}

	public function getnummatiere(): int
	{
		return $this->nummatiere;
	}

	public function getmoyenne(): floatval
	{
		return $this->moyenne;
	}

	public function getCoeff(): int
	{
		return $this->coeff;
	}

	public function getAlternant(): boolval
	{
		return $this->alternant;
	}

	public function getLibelle(): string
	{
		return $this->libelle;
	}

	private function setnummatiere( int $nummatiere )
	{
		$this->nummatiere = $nummatiere;
	}

	public function setmoyenne( floatval $moyenne )
	{
		$this->moyenne = $moyenne;
	}

	public function setCoeff( int $coeff )
	{
		$this->coeff = $coeff;
	}

	public function setAlternant( bool $alternant )
	{
		$this->alternant = $alternant;
	}

	public function setLibelle( string $libelle )
	{
		$this->libelle = $libelle;
	}

	public function __toString(): string
	{
		return "Matiere : moyenne = ".$this->moyenne.", coeff = ".$this->coeff.", alternant = ".$this->alternant.", libelle = ".$this->libelle;
	}
}
?>