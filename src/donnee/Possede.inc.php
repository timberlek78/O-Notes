<?php

class Possede {
	private $idIllustration;
	private $idConfigFPE;

	public function __construct($idIllustration, $idConfigFPE) {
		$this->idIllustration = $idIllustration;
		$this->idConfigFPE = $idConfigFPE;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getIdIllustration() {
		return $this->idIllustration;
	}

	public function setIdIllustration($idIllustration) {
		$this->idIllustration = $idIllustration;
	}

	public function getIdConfigFPE() {
		return $this->idConfigFPE;
	}

	public function setIdConfigFPE($idConfigFPE) {
		$this->idConfigFPE = $idConfigFPE;
	}
}

?>
