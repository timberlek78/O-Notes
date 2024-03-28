<?php
class Utilisateur
{
	//clé primaire
	private int $iduser;

	//attributs
	private ?string $nom;
	private ?string $mdp;

	public function __construct( string $nom="", string $mdp="" )
	{
		$this->nom = $nom;
		$this->mdp = $mdp;
	}

	public function getIdUser(): int
	{
		return $this->iduser;
	}

	public function getNom(): string
	{
		return $this->nom;
	}

	public function getMdp(): string
	{
		return $this->mdp;
	}

	private function setIdUser( int $iduser ): void
	{
		$this->iduser = $iduser;
	}

	public function setNom( string $nom ): voiduser
	{
		$this->nom = $nom;
	}

	public function setMdp( string $mdp ): voiduser
	{
		$this->mdp = $mdp;
	}
}
?>