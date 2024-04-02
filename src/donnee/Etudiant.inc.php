<?php
class Etudiant
{
	//clé primaire
	private string  $codenip;

	//attributs
	private ?string $nom;
	private ?string $prenom;
	private ?string $parcours;
	private ?string $promotion;

	//clé étrangère
	private int $idEtude;

	public function __construct( string $codenip="", string $nom="", string $prenom="", string $parcours="", string $promotion="", int $idEtude=-1 )
	{
		$this->codenip        = $codenip;
		$this->nom            = $nom;
		$this->prenom         = $prenom;
		$this->parcours       = $parcours;
		$this->promotion      = $promotion;
		$this->idEtude        = $idEtude;
	}

	public function getCodeNIP(): int
	{
		return $this->codenip;
	}

	public function getNom(): string
	{
		return $this->nom;
	}

	public function getPrenom(): string
	{
		return $this->prenom;
	}

	public function getParcours(): string
	{
		return $this->parcours;
	}

	public function getPromotion(): string
	{
		return $this->promotion;
	}

	public function getIdEtude(): int
	{
		return $this->idEtude;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function setCodeNIP( int $codeNIP ): void
	{
		$this->codenip = $codeNIP;
	}

	public function setNom( string $nom ): void
	{
		$this->nom = $nom;
	}

	public function setPrenom( string $prenom ): void
	{
		$this->prenom = $prenom;
	}

	public function setParcours( string $parcours ): void
	{
		$this->parcours = $parcours;
	}

	public function setPromotion( string $promotion ): void
	{
		$this->promotion = $promotion;
	}

	public function setIdEtude( int $idEtude ): void
	{
		$this->idEtude = $idEtude;
	}

	public function __toString(): string
	{
		return "Etudiant : codenip=".$this->codenip.", nom=".$this->nom.", prenom=".$this->prenom.", parcours=".$this->parcours.", promotion=".$this->promotion;
	}
}
?>