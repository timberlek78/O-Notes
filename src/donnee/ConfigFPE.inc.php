<?php

class ConfigFPE {
	private $idconfigfpe;
	private $nomdirecteur;
	private $anneepromo;

	public function __construct($idConfigFPE, $nomDirecteur, $anneePromo) {
		$this->idconfigfpe = $idConfigFPE;
		$this->nomdirecteur = $nomDirecteur;
		$this->anneepromo = $anneePromo;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getIdConfigFPE() {
		return $this->idconfigfpe;
	}

	public function setIdConfigFPE($idConfigFPE) {
		$this->idconfigfpe = $idConfigFPE;
	}

	public function getNomDirecteur() {
		return $this->nomdirecteur;
	}

	public function setNomDirecteur($nomDirecteur) {
		$this->nomdirecteur = $nomDirecteur;
	}

	public function getAnneePromo() {
		return $this->anneepromo;
	}

	public function setAnneePromo($anneePromo) {
		$this->anneepromo = $anneePromo;
	}
}

?>
