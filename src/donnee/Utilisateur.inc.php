<?php

class Utilisateur {
	private $idUtilisateur;
	private $mdp;

	public function __construct($idUtilisateur, $mdp) {
		$this->idUtilisateur = $idUtilisateur;
		$this->mdp = $mdp;
	}

	public function getIdUtilisateur() {
		return $this->idUtilisateur;
	}

	public function setIdUtilisateur($idUtilisateur) {
		$this->idUtilisateur = $idUtilisateur;
	}

	public function getMdp() {
		return $this->mdp;
	}

	public function setMdp($mdp) {
		$this->mdp = $mdp;
	}
}

?>
