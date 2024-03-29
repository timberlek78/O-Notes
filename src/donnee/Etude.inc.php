<?php
class Etude
{
	//clé primaire
	private int $idetude;

	//attributs
	private ?string $specialite;
	private ?string $typebac;

	//clé étrangère
	private ?int $idetudiant;

	public function __construct( string $specialite="", string $typebac="", int $idetudiant=-1 )
	{
		$this->specialite = $specialite;
		$this->typebac    = $typebac;
		$this->idetudiant = $idetudiant;
	}

	public function getEdEtude(): int
	{
		return $this->idetude;
	}

	public function getSpecialite(): string
	{
		return $this->specialite;
	}

	public function getTypeBac(): string
	{
		return $this->typebac;
	}

	public function getIdEtudiant(): int
	{
		return $this->idetudiant;
	}

	private function setIdEtude( int $idetude ): void
	{
		$this->idetude = $idetude;
	}

	public function setSpecialite( string $specialite ): void
	{
		$this->specialite = $specialite;
	}

	public function setTypeBsac( string $typebac ): void
	{
		$this->typebac = $typebac;
	}

	public function setIdEtudiant( int $idetudiant ): void
	{
		$this->idetudiant = $idetudiant;
	}
}
?>