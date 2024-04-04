<?php
class Semestre
{
	//clé primaire
	private int $numsemestre;

	public function __construct( $numSemestre=-1 )
	{
		$this->numsemestre = $numSemestre;
	}

	public function getEqClesPrimaires( ) : array
	{
		return array( "numsemestre" => $this->numsemestre );
	}

	public function getAttributs() : array { return get_object_vars($this);}

	public function getNumSemestre( ) : int
	{
		return $this->numsemestre;
	}

	public function setNumSemestre( int $numSemestre )
	{
		$this->numsemestre = $numSemestre;
	}

	public function __toString( ): string
	{
		return "Semestre : numsemestre=$this->numsemestre";
	}

	public function equals( Semestre $semestre ) : bool
	{
		return $this->numsemestre == $semestre->getId( );
	}
}
?>