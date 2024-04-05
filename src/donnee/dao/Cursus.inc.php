<?php

require_once "ObjetDAO.inc.php";

class Cursus extends ObjetDAO
{
	//clé primaire
	private string  $codenip;
	private int     $numsemestre;
	private string  $idcompetence;
	private string  $annee;

	//attributs
	private ?string $admission;

	public function __construct ( string $codenip="", int $numsemestre=-1, string $idcompetence="", string $annee="", string $admission="" )
	{
		$this->codenip      = $codenip;
		$this->numsemestre  = $numsemestre;
		$this->idcompetence = $idcompetence;
		$this->annee        = $annee;
		$this->admission    = $admission;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array ( "codenip"      => $this->codenip,
					   "numsemestre"  => $this->numsemestre,
					   "idcompetence" => $this->idcompetence,
					   "annee"        => $this->annee );
	}

	public function getEqAttributs ( ) : array
	{
		return array ( "codenip"      => $this->codenip,
					   "numsemestre"  => $this->numsemestre,
					   "idcompetence" => $this->idcompetence,
					   "annee"        => $this->annee,
					   "admission"    => $this->admission );
	}

	public function getCodeNIP ( ) : string
	{
		return $this->codenip;
	}

	public function setCodeNIP ( string $codeNIP )
	{
		$this->codenip = $codeNIP;
	}

	public function getNumSemestre ( ) : int
	{
		return $this->numsemestre;
	}

	public function setNumSemestre ( int $numSemestre )
	{
		$this->numsemestre = $numSemestre;
	}

	public function getIdCompetence ( ) : string
	{
		return $this->idcompetence;
	}

	public function setIdCompetence ( string $idCompetence )
	{
		$this->idcompetence = $idCompetence;
	}

	public function getAdmission ( ) : string
	{
		return $this->admission;
	}

	public function setAdmission ( string $admission )
	{
		$this->admission = $admission;
	}

	public function getAnnee ( ) : string
	{
		return $this->annee;
	}

	public function setAnnee ( string $annee )
	{
		$this->annee = $annee;
	}
}
?>