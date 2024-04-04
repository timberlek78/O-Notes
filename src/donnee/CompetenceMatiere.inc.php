<?php
class CompetenceMatiere
{
	//clé primaire
	private string $idcompetence;
	private string $annee;
	private string $idmatiere;

	//attributs
	private int $coeff;

	public function __construct( string $idCompetence="", string $annee ="",string $idMatiere="", int $coeff=1 )
	{
		$this->idcompetence = $idCompetence;
		$this->annee        = $annee;
		$this->idmatiere    = $idMatiere;
		$this->coeff        = $coeff;
	}

	public function getEqClesPrimaires( ) : array
	{
		return array( "idcompetence" => $this->idcompetence,
					  "annee"        => $this->annee,
					  "idmatiere"    => $this->idmatiere);
	}

	public function getEqAttributs() : array
	{
		return array( "idcompetence" => $this->idcompetence,
					  "annee"        => $this->annee,
					  "idmatiere"    => $this->idmatiere,
					  "coeff"        => $this->coeff);
	}

	public function getIdCompetence(): string
	{
		return $this->idcompetence;
	}

	public function getIdMatiere(): string
	{
		return $this->idmatiere;
	}

	public function getAnnee(): string
	{
		return $this->annee;
	}

	public function getCoeff(): int
	{
		return $this->coeff;
	}

	public function setIdCompetence( string $idCompetence )
	{
		$this->idcompetence = $idCompetence;
	}

	public function setAnnee( string $annee )
	{
		$this->annee = $annee;
	}

	public function setIdMatiere( string $idMatiere )
	{
		$this->idmatiere = $idMatiere;
	}

	public function __toString(): string
	{
		return "CompetenceMatiere : idcompetence = ".$this->idcompetence.", annee = ".$this->annee.", idmatiere = ".$this->idmatiere;
	}

	public function setCoeff( int $coeff )
	{
		$this->coeff = $coeff;
	}

	public function equals( CompetenceMatiere $competenceMatiere ) : bool
	{
		return $this->idcompetence == $competenceMatiere->getIdCompetence( ) && $this->idmatiere == $competenceMatiere->getIdMatiere( ) && $this->annee == $competenceMatiere->getAnnee( );
	}
}
?>