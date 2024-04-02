<?php
class Etude
{
	//clé primaire
	private int $idetude;

	//attributs
	private ?string $specialite;
	private ?string $typebac;


	public function __construct( string $specialite="", string $typebac="" )
	{
		$this->specialite = $specialite;
		$this->typebac    = $typebac;
	}
	
	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getSpecialite(): string
	{
		return $this->specialite;
	}

	public function getTypeBac(): string
	{
		return $this->typebac;
	}

	public function setSpecialite( string $specialite ): void
	{
		$this->specialite = $specialite;
	}

	public function setTypeBac( string $typebac ): void
	{
		$this->typebac = $typebac;
	}

	public function __toString(): string
	{
		return "Etude : specialite = ".$this->specialite.", typebac = ".$this->typebac;
	}
}
?>