<?php

class Utilisateur
{
	//clé primaire
	private $idutilisateur;

	//attributs
	private $mdp;

	public function __construct($idUtilisateur, $mdp) {
		$this->idutilisateur = $idUtilisateur;
		$this->mdp = $mdp;
	}

	public function getEqClesPrimaires() : array {
		return array( "idutilisateur" => $this->idutilisateur );
	}

	public function getIdUtilisateur() {
		return $this->idutilisateur;
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

	public function __toString() {
		return "Utilisateur : idutilisateur = ".$this->idutilisateur.", mdp = ".$this->mdp;
	}

	public function equals(Utilisateur $utilisateur) : bool {
		return $this->idutilisateur == $utilisateur->getIdUtilisateur();
	}
}

?>
