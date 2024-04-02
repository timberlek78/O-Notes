<?php

class ConfigFPE {
	private $idConfigFPE;
	private $nomDirecteur;
	private $anneePromo;

	public function __construct($idConfigFPE, $nomDirecteur, $anneePromo) {
		$this->idConfigFPE = $idConfigFPE;
		$this->nomDirecteur = $nomDirecteur;
		$this->anneePromo = $anneePromo;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getIdConfigFPE() {
		return $this->idConfigFPE;
	}

	public function setIdConfigFPE($idConfigFPE) {
		$this->idConfigFPE = $idConfigFPE;
	}

	public function getNomDirecteur() {
		return $this->nomDirecteur;
	}

	public function setNomDirecteur($nomDirecteur) {
		$this->nomDirecteur = $nomDirecteur;
	}

	public function getAnneePromo() {
		return $this->anneePromo;
	}

	public function setAnneePromo($anneePromo) {
		$this->anneePromo = $anneePromo;
	}
}

?>
