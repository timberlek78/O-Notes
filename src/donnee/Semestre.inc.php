<?php
class Semestre
{
	//clé primaire
	private int $numsemestre;

	public function __construct( ){}

	public function getAttributs() : array { return get_object_vars($this);}
	public function getId       () : int   { return $this->numSemestre;    }

	public function setNumSemestre( int $numSemestre )
	{
		$this->numsemestre = $numSemestre;
	}

	public function __toString( ): string
	{
		return "Semestre : numsemestre=$this->numsemestre";
	}
}
?>