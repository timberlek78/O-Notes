<?php

require_once "ObjetDAO.inc.php";

class Competence extends ObjetDAO
{
	//clé primaire
	private string $idcompetence;
	private ?string $annee;

	private $tabMatiere;

	public function __construct ( string $idcompetence="",string $annee="" )
	{
		$this->idcompetence = $idcompetence;
		$this->annee        = $annee;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array ( "idcompetence" => $this->idcompetence,
					   "annee"        => $this->annee );
	}

	public function getEqAttributs ( ) : array
	{
		return array ( "idcompetence" => $this->idcompetence,
					   "annee"        => $this->annee );
	}

	public function getIdCompetence ( ) : string
	{
		return $this->idcompetence;
	}

	public function getAnnee ( ) : string
	{
		return $this->annee;
	}

	public function getTabMatieres ( )
	{
		return $this->tabMatiere;
	}

	public function setTabMatieres ( $tabmatiere )
	{
		$this->tabMatiere = $tabmatiere;
	}

	public function setIdCompetence ( string $idCompetence )
	{
		$this->idcompetence = $idCompetence;
	}

	public function setAnnee ( string $annee )
	{
		$this->annee = $annee;
	}
}
?>