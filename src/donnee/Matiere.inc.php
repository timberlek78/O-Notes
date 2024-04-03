<?php

class Matiere {
	private string $idmatiere;
	private bool $alternant;

	public function __construct( $idMatiere="", $alternant=false )
	{
		$this->idmatiere = $idMatiere;
		$this->alternant = $alternant;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getIdMatiere( ) : string
	{
		return $this->idmatiere;
	}

	public function setIdMatiere( $idMatiere )
	{
		$this->idmatiere = $idMatiere;
	}

	public function getAlternant() : bool
	{
		return $this->alternant;
	}

	public function setAlternant( $alternant )
	{
		$this->alternant = $alternant;
	}

	public function __toString(): string
	{
		return "Matiere : idmatiere = ".$this->idmatiere.", alternant = ".$this->alternant;
	}

	public function equals( Matiere $matiere ) : bool
	{
		return $this->idmatiere == $matiere->getIdMatiere( );
	}
}

?>
