<?php
class Semestre
{
	//clé primaire
	private int $numsemestre;

	public function __construct( )
	{
	}

	public function getnumsemestre(): int
	{
		return $this->numsemestre;
	}

	public function setnumsemestre( int $numsemestre )
	{
		$this->numsemestre = $numsemestre;
	}

	public function __toString( ): string
	{
		return "Semestre : numsemestre=$this->numsemestre";
	}
}
?>