<?php
class Possede
{
	//clé primaire
	private int $idillustration;
	private int $idfpe;

	public function __construct( int $idillustration=-1, int $idfpe=-1 )
	{
		$this->idillustration = $idillustration;
		$this->idfpe          = $idfpe;
	}

	public function getId(): int
	{
		return $this->idillustration;
	}

	public function getIdFpe(): int
	{
		return $this->idfpe;
	}

	private function setIdIllustration( int $idillustration ): void
	{
		$this->idillustration = $idillustration;
	}

	private function setidfpe( int $idfpe ): void
	{
		$this->idfpe = $idfpe;
	}
}
?>