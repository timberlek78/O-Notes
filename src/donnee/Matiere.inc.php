<?php

class Matiere {
	private $idMatiere;
	private $alternant;

	public function __construct( $idMatiere, $alternant )
	{
		$this->idMatiere = $idMatiere;
		$this->alternant = $alternant;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getIdMatiere( )
	{
		return $this->idMatiere;
	}

	public function setIdMatiere( $idMatiere )
	{
		$this->idMatiere = $idMatiere;
	}

	public function getAlternant()
	{
		return $this->alternant;
	}

	public function setAlternant( $alternant )
	{
		$this->alternant = $alternant;
	}
}

?>
