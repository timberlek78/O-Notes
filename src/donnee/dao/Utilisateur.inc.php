<?php

require_once "ObjetDAO.inc.php";

class Utilisateur extends ObjetDAO
{
	//clé primaire
	private string $idutilisateur;

	//attributs
	private string $mdp;

	public function __construct ( string $idUtilisateur, string $mdp )
	{
		$this->idutilisateur = $idUtilisateur;
		$this->mdp           = $mdp;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array ( "idutilisateur" => $this->idutilisateur );
	}

	public function getEqAttributs ( ) : array
	{
		return array ( "idutilisateur" => $this->idutilisateur,
					   "mdp"           => $this->mdp );
	}

	public function getIdUtilisateur ( ) : string
	{
		return $this->idutilisateur;
	}

	public function setIdUtilisateur ( $idUtilisateur )
	{
		$this->idutilisateur = $idUtilisateur;
	}

	public function getMdp ( ) : string
	{
		return $this->mdp;
	}

	public function setMdp ( $mdp )
	{
		$this->mdp = $mdp;
	}
}
?>