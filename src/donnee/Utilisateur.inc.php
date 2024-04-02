<?php

class Utilisateur {
	private $idutilisateur;
	private $mdp;

	public function __construct($idutilisateur = -1, $mdp ="") {
		$this->idutilisateur = $idutilisateur;
		$this->mdp = $mdp;
	}

	public function getIdUtilisateur() {
		return $this->idutilisateur;
	}

	public function setIdUtilisateur($idutilisateur) {
		$this->idutilisateur = $idutilisateur;
	}

	public function getMdp() {
		return $this->mdp;
	}

	public function setMdp($mdp) {
		$this->mdp = $mdp;
	}
}

?>
