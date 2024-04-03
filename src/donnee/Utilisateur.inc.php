<?php

class Utilisateur {
	private $idutilisateur;
	private $mdp;

	public function __construct($idUtilisateur, $mdp) {
		$this->idutilisateur = $idUtilisateur;
		$this->mdp = $mdp;
	}

	public function getIdUtilisateur() {
		return $this->idutilisateur;
	}

	public function setIdUtilisateur($idUtilisateur) {
		$this->idutilisateur = $idUtilisateur;
	}

	public function getMdp() {
		return $this->mdp;
	}

	public function setMdp($mdp) {
		$this->mdp = $mdp;
	}
}

?>
