<?php

class Illustration {
	private $idillustration;
	private $img;
	private $alternative;

	public function __construct($idIllustration, $img, $alternative) {
		$this->idillustration = $idIllustration;
		$this->img = $img;
		$this->alternative = $alternative;
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
