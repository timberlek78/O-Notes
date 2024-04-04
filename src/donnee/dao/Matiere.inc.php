<?php

require_once "ObjetDAO.inc.php";

class Matiere extends ObjetDAO
{
	//clé primaire
	private string $idmatiere;

	//attributs
	private bool $alternant;

	public function __construct( string $idMatiere="", bool $alternant=false )
	{
		$this->idmatiere = $idMatiere;
		$this->alternant = $alternant;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array ( "idmatiere" => $this->idmatiere );
	}

	public function getEqAttributs ( ) : array
	{
		return array( "idmatiere" => $this->idmatiere,
					  "alternant" => $this->alternant );
	}

	public function getIdMatiere ( ) : string
	{
		return $this->idmatiere;
	}

	public function setIdMatiere ( string $idMatiere )
	{
		$this->idmatiere = $idMatiere;
	}

	public function getAlternant ( ) : bool
	{
		return $this->alternant;
	}

	public function setAlternant ( bool $alternant )
	{
		$this->alternant = $alternant;
	}
}
?>
