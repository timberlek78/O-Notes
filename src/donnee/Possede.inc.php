<?php
class Possede
{
	//clé primaire
	private int $idIllustration;
	private int $idFPE;

	public function __construct( int $idIllustration, int $idFPE )
	{
		$this->idIllustration = $idIllustration;
		$this->idFPE          = $idFPE;
	}

	public function getIdIllustration(): int
	{
		return $this->idIllustration;
	}

	public function getIdFPE(): int
	{
		return $this->idFPE;
	}

	private function setIdIllustration( int $idIllustration ): void
	{
		$this->idIllustration = $idIllustration;
	}

	private function setIdFPE( int $idFPE ): void
	{
		$this->idFPE = $idFPE;
	}
}
?>