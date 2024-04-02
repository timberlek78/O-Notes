<?php
class CompetenceMatiere
{
	//clé primaire
	private string $idcompetence;
	private string $annee;
	private string $idmatiere;

	public function __construct( string $idCompetence="", string $annee ="",string $idMatiere="" )
	{
		$this->idcompetence = $idCompetence;
		$this->annee        = $annee;
		$this->idmatiere   = $idMatiere;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getIds() : array
	{
		return [$this->idcompetence, $this->annee, $this->idmatiere];
	}


	public function getIdCompetence(): string
	{
		return $this->idcompetence;
	}

	public function getIdMatiere(): string
	{
		return $this->idmatiere;
	}

	private function setIdCompetence( string $idCompetence )
	{
		$this->idcompetence = $idCompetence;
	}

	private function setIdMatiere( string $idMatiere )
	{
		$this->idmatiere = $idMatiere;
	}
}
?>