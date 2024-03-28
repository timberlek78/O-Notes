<?php
class Illustration
{
	//clé primaire
	private int $id;

	//attributs
	private ?string $img;
	private ?string $alternative;

	public function __construct( string $img="", string $alternative="" )
	{
		$this->img         = $img;
		$this->alternative = $alternative;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getImg(): string
	{
		return $this->img;
	}

	public function getAlternative(): string
	{
		return $this->alternative;
	}

	private function setId( int $id ): void
	{
		$this->id = $id;
	}

	public function setImg( string $img ): void
	{
		$this->img = $img;
	}

	public function setAlternative( string $alternative ): void
	{
		$this->alternative = $alternative;
	}
}
?>