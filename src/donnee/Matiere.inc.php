<?php
class Matiere
{
	//clé primaire
	private int $id;

	//attributs
	private floatval $note;
	private int      $coeff;
	private boolval  $alternant;
	private string   $libelle;

	public function __construct( floatval $note, int $coeff, boolval $alternant, string $libelle )
	{
		$this->note      = $note;
		$this->coeff     = $coeff;
		$this->alternant = $alternant;
		$this->libelle   = $libelle;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getNote(): floatval
	{
		return $this->note;
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

	private function setId( int $id ): void
	{
		$this->id = $id;
	}

	public function setNote( floatval $note ): void
	{
		$this->note = $note;
	}

	public function setCoeff( int $coeff ): void
	{
		$this->coeff = $coeff;
	}

	public function setAlternant( boolval $alternant ): void
	{
		$this->alternant = $alternant;
	}

	public function setLibelle( string $libelle ): void
	{
		$this->libelle = $libelle;
	}
}
?>