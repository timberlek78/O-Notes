<?php
class CursusFetch
{
	public string $idcompetence;
	public string $admission;
	public $tabMatiere;

	public function __construct($idcompetence, $admission)
	{
		$this->idcompetence = $idcompetence;
		$this->admission    = $admission;
		$this->tabMatiere = array();
	}

	public function addMatiere($matiere)
	{
		$this->tabMatiere[] = $matiere;
	}
}
?>