<?php
class Semestre
{
	//clé primaire
	private int $id;

	public function __construct( )
	{
	}

	public function getId(): int
	{
		return $this->id;
	}

	private function setId( int $id ): void
	{
		$this->id = $id;
	}
}
?>