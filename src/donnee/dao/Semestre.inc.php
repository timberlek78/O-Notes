<?php

require_once "ObjetDAO.inc.php";

class Semestre extends ObjetDAO
{
	//clé primaire
	private int $numsemestre;

	public function __construct ( int $numSemestre=-1 )
	{
		$this->numsemestre = $numSemestre;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array( "numsemestre" => $this->numsemestre );
	}

	public function getEqAttributs ( ) : array
	{
		return array ( "numsemestre" => $this->numsemestre );
	}

	public function getNumSemestre ( ) : int
	{
		return $this->numsemestre;
	}

	public function setNumSemestre ( int $numSemestre )
	{
		$this->numsemestre = $numSemestre;
	}
}
?>