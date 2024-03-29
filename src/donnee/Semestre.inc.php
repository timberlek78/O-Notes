<?php
class Semestre
{
	//clé primaire
	private int $numsemestre;

	public function __construct( )
	{
	}

	public function getId(): int
	{
		return $this->numsemestre;
	}

	private function setnumsemestre( int $numsemestre ): vonumsemestre
	{
		$this->numsemestre = $numsemestre;
	}
}
?>