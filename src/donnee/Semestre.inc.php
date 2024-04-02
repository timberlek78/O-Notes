<?php
class Semestre
{
	//clé primaire
	private int $numsemestre;

	public function __construct( ){}

	public function getAttributs() : array { return get_object_vars($this);}
	public function getId       () : int   { return $this->numsemestre;    }

	private function setnumsemestre( int $numsemestre ): vonumsemestre
	{
		$this->numsemestre = $numsemestre;
	}
}
?>