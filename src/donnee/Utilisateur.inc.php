<?php

class Utilisateur
{
	//clé primaire
	private $nomutilisateur;

	//attributs
	private $mdp;
	private $acces;

	public function __construct ( $nomutilisateur = "", $mdp = "", $acces = "" )
	{
		$this->nomutilisateur = $nomutilisateur;
		$this->mdp            = $mdp;
		$this->acces          = $acces;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array ( "nomutilisateur" => $this->nomutilisateur );
	}

	public function getEqAttributs ( ) : array
	{
		return $this->getEqClesPrimaires ( );
	}

	public function getNomUtilisateur ( ) { return $this->nomutilisateur; }
	public function getMdp            ( ) { return $this->mdp;            }
	public function getAcces          ( ) { return $this->acces;          }

	public function setNomUtilisateur ( $nomutilisateur ) { $this->nomutilisateur = $nomutilisateur; }
	public function setMdp            ( $mdp            ) { $this->mdp            = $mdp;            }
	public function setAcces          ( $acces          ) { $this->acces          = $acces;          }

	public function __toString()
	{
		return "Utilisateur : nomutilisateur = ".$this->nomutilisateur.", mdp = ".$this->mdp;
	}

	public function equals ( Utilisateur $utilisateur ) : bool
	{
		return $this->nomutilisateur == $utilisateur->getnomutilisateur ( );
	}
}
?>