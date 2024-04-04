<?php

class EstNote
{
	//clé primaire
	private string $codenip;
	private string $idmatiere;

	//attributs
	private float $moyenne;

	public function __construct( $codenip = -1, $idmatiere = "", $moyenne = -1.0 )
	{
		$this->codenip   = $codenip;
		$this->idmatiere = $idmatiere;
		$this->moyenne   = $moyenne;
	}

	public function getEqClesPrimaires( ) : array
	{
		return array( "codenip"   => $this->codenip,
					  "idmatiere" => $this->idmatiere );
	}

	public function getAttributs( ) : array
	{
		return get_object_vars( $this );
	}

	public function getCodeNip( )
	{
		return $this->codenip;
	}

	public function setCodeNip( $codenip )
	{
		$this->codenip = $codenip;
	}

	public function getIdMatiere( )
	{
		return $this->idmatiere;
	}

	public function setIdMatiere( $idmatiere )
	{
		$this->idmatiere = $idmatiere;
	}

	public function getMoyenne( )
	{
		return $this->moyenne;
	}

	public function setMoyenne( $moyenne )
	{
		$this->moyenne = $moyenne;
	}

	public function __toString( )
	{
		return "EstNote : codenip = ".$this->codenip.", idmatiere = ".$this->idmatiere.", moyenne = ".$this->moyenne;
	}

	public function equals( EstNote $estNote ) : bool
	{
		return $this->codenip == $estNote->getCodeNip( ) && $this->idmatiere == $estNote->getIdMatiere( );
	}
}
?>