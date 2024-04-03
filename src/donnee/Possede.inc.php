<?php

class Possede {
	private $idillustration;
	private $idconfigfpe;

	public function __construct($idIllustration, $idConfigFPE) {
		$this->idillustration = $idIllustration;
		$this->idconfigfpe = $idConfigFPE;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
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
}

?>
