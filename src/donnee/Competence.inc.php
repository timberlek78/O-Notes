<?php
class Competence
{
	//clé primaire
	private string $idcompetence;

	//attributs
	private ?string $annee;

	public function __construct( string $idCompetence="", $annee="" )
	{
		$this->idcompetence = $idCompetence;
		$this->annee   = $annee;
	}

	public function getAttributs( ) : array
	{
		return get_object_vars($this);
	}

	public function getIdCompetence( ) : string
	{
		return $this->idcompetence;
	}

	public function getAnnee( ) : string
	{
		return $this->annee;
	}

	public function setIdCompetence( string $idCompetence )
	{
		$this->idcompetence = $idCompetence;
	}

	public function setAnnee ( string $annee )
	{
		$this->annee = $annee;
	}

	public function __toString(): string
	{
		return "Competence : idcompetence = ".$this->idcompetence.", annee = ".$this->annee;
	}

	public function equals( Competence $competence ) : bool
	{
		return $this->idcompetence == $competence->getIdCompetence( );
	}
}
?>