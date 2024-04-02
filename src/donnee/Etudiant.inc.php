<?php
class Etudiant
{
	//clé primaire
	private int     $codeNIP;

	//attributs
	private ?string $nom;
	private ?string $prenom;
	private ?string $parcours;
	private ?string $promotion;

	//clé étrangère
	private int $idillustration;
	private int $idEtude;

	public function __construct( int $codenip=-1, string $nom="", string $prenom="", string $parcours="", string $promotion="", int $idillustration=-1, int $idEtude )
	{
		$this->codenip        = $codenip;
		$this->nom            = $nom;
		$this->prenom         = $prenom;
		$this->parcours       = $parcours;
		$this->promotion      = $promotion;
		$this->idillustration = $idillustration;
		$this->idEtude        = $idEtude;
	}

	public function getNIP(): int
	{
		return $this->codeNIP;
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

	public function getidillustration(): int
	{
		return $this->idillustration;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function setcodeNIP( int $codeNIP ): void
	{
		$this->codeNIP = $codeNIP;
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

	public function setidillustration( int $idillustration ): void
	{
		$this->idillustration = $idillustration;
	}

	public function __toString(): string
	{
		return "Etudiant : codenip=".$this->codenip.", nom=".$this->nom.", prenom=".$this->prenom.", parcours=".$this->parcours.", promotion=".$this->promotion.", idillustration=".$this->idillustration;
	}
}
?>