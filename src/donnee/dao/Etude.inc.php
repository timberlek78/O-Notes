<?php

require_once "ObjetDAO.inc.php";

class Etude extends ObjetDAO
{
	//clé primaire
	private ?string $specialite;
	private ?string $typebac;

	public function __construct ( string $specialite="", string $typebac="" )
	{
		$this->specialite = $specialite;
		$this->typebac    = $typebac;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array( "specialite" => $this->specialite,
					  "typebac"    => $this->typebac );
	}
	
	public function getEqAttributs ( ) : array
	{
		return array ( "specialite" => $this->specialite,
					   "typebac"    => $this->typebac );
	}

	public function getSpecialite ( ) : string
	{
		return $this->specialite;
	}

	public function setSpecialite ( string $specialite )
	{
		$this->specialite = $specialite;
	}

	public function getTypeBac ( ) : string
	{
		return $this->typebac;
	}

	public function setTypeBac ( string $typebac )
	{
		$this->typebac = $typebac;
	}
}
?>