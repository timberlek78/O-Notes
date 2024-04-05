<?php

require_once "ObjetDAO.inc.php";

class Possede extends ObjetDAO
{
	//clé primaire
	private int $idillustration;
	private int $idconfigfpe;

	public function __construct ( int $idIllustration, int $idConfigFPE )
	{
		$this->idillustration = $idIllustration;
		$this->idconfigfpe    = $idConfigFPE;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array( "idillustration" => $this->idillustration,
					  "idconfigfpe"    => $this->idconfigfpe );
	}

	public function getEqAttributs ( ) : array
	{
		return array( "idillustration" => $this->idillustration,
					  "idconfigfpe"    => $this->idconfigfpe );
	}

	public function getIdIllustration ( ) : int
	{
		return $this->idillustration;
	}

	public function setIdIllustration ( int $idIllustration )
	{
		$this->idillustration = $idIllustration;
	}

	public function getIdConfigFPE ( ) : int
	{
		return $this->idconfigfpe;
	}

	public function setIdConfigFPE ( int $idConfigFPE )
	{
		$this->idconfigfpe = $idConfigFPE;
	}
}
?>