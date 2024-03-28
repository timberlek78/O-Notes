<?php
class Utilisateur
{
	//clé primaire
	private int $id;

	//attributs
	private ?string $nom;
	private ?string $mdp;

	public function __construct( string $nom="", string $mdp="" )
	{
		$this->nom = $nom;
		$this->mdp = $mdp;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getNom(): string
	{
		return $this->nom;
	}

	public function getMdp(): string
	{
		return $this->mdp;
	}

	private function setId( int $id ): void
	{
		$this->id = $id;
	}

	public function setNom( string $nom ): void
	{
		$this->nom = $nom;
	}

	public function setMdp( string $mdp ): void
	{
		$this->mdp = $mdp;
	}
}
?>