<?php
class Etudiant
{
	//clé primaire
	private int $id;

	//attributs
	private int    $codeNIP;
	private string $nom;
	private string $prenom;
	private string $parcours;
	private string $promotion;

	//clé étrangère
	private int $idIllustration;

	public function __construct( int $codeNIP, string $nom, string $prenom, string $parcours, string $promotion, int $idIllustration )
	{
		$this->codeNIP        = $codeNIP;
		$this->nom            = $nom;
		$this->prenom         = $prenom;
		$this->parcours       = $parcours;
		$this->promotion      = $promotion;
		$this->idIllustration = $idIllustration;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getCodeNIP(): int
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

	public function getIdIllustration(): int
	{
		return $this->idIllustration;
	}

	private function setId( int $id ): void
	{
		$this->id = $id;
	}

	public function setCodeNIP( int $codeNIP ): void
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

	public function setIdIllustration( int $idIllustration ): void
	{
		$this->idIllustration = $idIllustration;
	}
}
?>