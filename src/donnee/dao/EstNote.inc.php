<?php

include_once "ObjetDAO.inc.php";

class EstNote
{
	//clé primaire
	private string $codenip;
	private string $idmatiere;

	//attributs
	private float $moyenne;

	public function __construct ( $codenip = -1, $idmatiere = "", $moyenne = -1.0 )
	{
		$this->codenip   = $codenip;
		$this->idmatiere = $idmatiere;
		$this->moyenne   = $moyenne;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array ( "codenip"   => $this->codenip,
					   "idmatiere" => $this->idmatiere );
	}

	public function getEqAttributs ( ) : array
	{
		return array ( "codenip"   => $this->codenip,
					   "idmatiere" => $this->idmatiere,
					   "moyenne"   => $this->moyenne );
	}

	public function getCodeNip ( )
	{
		return $this->codenip;
	}

	public function setCodeNip ( $codenip )
	{
		$this->codenip = $codenip;
	}

	public function getIdMatiere ( )
	{
		return $this->idmatiere;
	}

	public function setIdMatiere ( $idmatiere )
	{
		$this->idmatiere = $idmatiere;
	}

	public function getMoyenne ( )
	{
		return $this->moyenne;
	}

	public function setMoyenne ( $moyenne )
	{
		$this->moyenne = $moyenne;
	}
}
?>