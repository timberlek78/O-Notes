<?php

class Matiere {
	private $idmatiere;
	private $alternant;

	public function __construct($idmatiere = "", $alternant = "") {
		$this->idmatiere = $idmatiere;
		$this->alternant = $alternant;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getId() {
		return $this->idmatiere;
	}

	public function setidmatiere($idmatiere) {
		$this->idmatiere = $idmatiere;
	}

	public function getAlternant() {
		return $this->alternant;
	}

	public function setAlternant($alternant) {
		$this->alternant = $alternant;
	}
}

?>
