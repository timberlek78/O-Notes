<?php
class Illustration
{
	//clé primaire
	private int $idillustration;

	//attributs
	private ?string $img;
	private ?string $alternative;

	public function __construct( string $img="", string $alternative="" )
	{
		$this->img         = $img;
		$this->alternative = $alternative;
	}

	public function getIdIllustration(): int
	{
		return $this->idillustration;
	}

	public function getImg(): string
	{
		return $this->img;
	}

	public function getAlternative(): string
	{
		return $this->alternative;
	}

	private function setIdIllustration( int $idillustration ): voidillustration
	{
		$this->idillustration = $idillustration;
	}

	public function setImg( string $img ): voidillustration
	{
		$this->img = $img;
	}

	public function setAlternative( string $alternative ): voidillustration
	{
		$this->alternative = $alternative;
	}
}
?>