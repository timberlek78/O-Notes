<?php

class Illustration
{
	//clé primaire
	private $idillustration;

	//attributs
	private $img;
	private $alternative;

	public function __construct($idIllustration, $img, $alternative) {
		$this->idillustration = $idIllustration;
		$this->img = $img;
		$this->alternative = $alternative;
	}

	public function getEqClesPrimaires() : array
	{
		return array("idillustration" => $this->idillustration);
	}

	public function getEqAttributs() : array
	{
		return array("idillustration" => $this->idillustration,
					 "img"            => $this->img,
					 "alternative"    => $this->alternative);
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

	public function __toString() {
		return "Illustration : idillustration = ".$this->idillustration.", img = ".$this->img.", alternative = ".$this->alternative;
	}

	public function equals(Illustration $illustration) : bool 
	{
		return $this->idillustration == $illustration->getIdIllustration();
	}
}

?>
