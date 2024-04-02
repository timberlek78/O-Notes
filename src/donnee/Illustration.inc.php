<?php

class Illustration {
	private $idIllustration;
	private $img;
	private $alternative;

	public function __construct($idIllustration, $img, $alternative) {
		$this->idIllustration = $idIllustration;
		$this->img = $img;
		$this->alternative = $alternative;
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

	public function getImg() {
		return $this->img;
	}

	public function setImg($img) {
		$this->img = $img;
	}

	public function getAlternative() {
		return $this->alternative;
	}

	public function setAlternative($alternative) {
		$this->alternative = $alternative;
	}
}

?>
