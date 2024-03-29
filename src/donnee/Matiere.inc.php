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
		$this->moyenne      = $moyenne;
		$this->coeff     = $coeff;
		$this->alternant = $alternant;
		$this->libelle   = $libelle;
	}

	public function getId(): int
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

	private function setnummatiere( int $nummatiere ): vonummatiere
	{
		$this->nummatiere = $nummatiere;
	}

	public function setmoyenne( floatval $moyenne ): vonummatiere
	{
		$this->moyenne = $moyenne;
	}

	public function setCoeff( int $coeff ): vonummatiere
	{
		$this->coeff = $coeff;
	}

	public function setAlternant( boolval $alternant ): vonummatiere
	{
		$this->alternant = $alternant;
	}

	public function setLibelle( string $libelle ): vonummatiere
	{
		$this->libelle = $libelle;
	}
}
?>