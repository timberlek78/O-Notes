<?php

class Matiere
{
	//clé primaire
	private string $idmatiere;

	//attributs
	private bool $alternant;

	public function __construct( $idMatiere="", $alternant=false )
	{
		$this->idmatiere = $idMatiere;
		$this->alternant = $alternant;
	}

	public function getEqClesPrimaires( ) : array
	{
		return array( "idmatiere" => $this->idmatiere );
	}

	public function getEqAttributs() : array
	{
		return array( "idmatiere" => $this->idmatiere,
					  "alternant" => $this->alternant);
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
