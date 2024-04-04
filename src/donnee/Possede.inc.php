<?php

class Possede
{
	//clé primaire
	private $idillustration;
	private $idconfigfpe;

	public function __construct($idIllustration, $idConfigFPE) {
		$this->idillustration = $idIllustration;
		$this->idconfigfpe = $idConfigFPE;
	}

	public function getEqClesPrimaires() : array
	{
		return array( "idillustration" => $this->idillustration,
					  "idconfigfpe" => $this->idconfigfpe );
	}

	public function getEqAttributs() : array
	{
		return array( "idillustration" => $this->idillustration,
					  "idconfigfpe" => $this->idconfigfpe );
	}

	public function getIdIllustration() {
		return $this->idillustration;
	}

	public function setIdIllustration($idIllustration) {
		$this->idillustration = $idIllustration;
	}

	public function getIdConfigFPE() {
		return $this->idconfigfpe;
	}

	public function setIdConfigFPE($idConfigFPE) {
		$this->idconfigfpe = $idConfigFPE;
	}

	public function __toString() {
		return "Possede : idillustration = ".$this->idillustration.", idconfigfpe = ".$this->idconfigfpe;
	}

	public function equals(Possede $possede) : bool {
		return $this->idillustration == $possede->getIdIllustration() && $this->idconfigfpe == $possede->getIdConfigFPE();
	}
}

?>
