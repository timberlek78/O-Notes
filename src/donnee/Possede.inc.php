<?php

class Possede {
	private $idIllustration;
	private $idconfigfpe;

	public function __construct($idIllustration = -1, $idconfigfpe = -1) {
		$this->idIllustration = $idIllustration;
		$this->idconfigfpe = $idconfigfpe;
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

	public function getIdConfigFpe() {
		return $this->idconfigfpe;
	}

	public function setIdConfigFpe($idConfigFpe) {
		$this->idconfigfpe = $idConfigFpe;
	}
}

?>
