<?php
class Etudiant
{
	//clé primaire
	private int $idetudiant;

	//attributs
	private ?int    $codenip;
	private ?string $nom;
	private ?string $prenom;
	private ?string $parcours;
	private ?string $promotion;

	//clé étrangère
	private int $idillustration;

	public function __construct(?int $id = -1, int $codenip=-1, string $nom="", string $prenom="", string $parcours="", string $promotion="", int $idillustration=-1 )
	{
		$this->idetudiant      = $id;
		$this->codenip        = $codenip;
		$this->nom            = $nom;
		$this->prenom         = $prenom;
		$this->parcours       = $parcours;
		$this->promotion      = $promotion;
		$this->idillustration = $idillustration;
	}

	public function getId(): int
	{
		return $this->idetudiant;
	}

	public function getNIP(): int
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

	public function getidillustration(): int
	{
		return $this->idillustration;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	

	public function setId( int $id ): void
	{
		$this->id = $id;
	}

	public function setcodenip( int $codenip ): void
	{
		$this->codenip = $codenip;
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
}
?>