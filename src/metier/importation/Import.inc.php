<?php

class Import {
	private $annee;
	private $semestre;
	private $estAlternance;
	private $fichierJury;
	private $fichierMoyenne;

	public function __construct($annee="", $semestre=-1)
	{
		$this->annee          = $annee;
		$this->semestre       = substr($semestre, 1, 2);
		$this->fichierJury    = array();
		$this->fichierMoyenne = array();
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getAnnee()
	{
		return $this->annee;
	}

	public function setAnnee($annee)
	{
		$this->annee = $annee;
	}

	public function getSemestre()
	{
		return $this->semestre;
	}

	public function setSemestre($semestre)
	{
		$this->semestre       = substr($semestre, 1, 2);
		$this->estAlternance  = strlen($semestre) > 5 ? 1 : 0;
	}

	public function estAlternance()
	{
		return $this->estAlternance;
	}

	public function getFichierJury()
	{
		return $this->fichierJury;
	}

	public function setFichierJury($fichierJury)
	{
		$this->fichierJury = $fichierJury;
	}

	public function getFichierMoyenne()
	{
		return $this->fichierMoyenne;
	}

	public function setFichierMoyenne($fichierMoyenne)
	{
		$this->fichierMoyenne = $fichierMoyenne;
	}

	// Attributs de Fichier Jury

	public function setFichierJuryType($type)
	{
		$this->fichierJury['type'] = $type;
	}

	public function setFichierJuryTmpName($tmp_name)
	{
		$this->fichierJury['tmp_name'] = $tmp_name;
	}

	public function setFichierJuryError($error)
	{
		$this->fichierJury['error'] = $error;
	}

	// Attributs de Fichier Moyenne

	public function setFichierMoyenneType($type)
	{
		$this->fichierMoyenne['type'] = $type;
	}

	public function setFichierMoyenneTmpName($tmp_name)
	{
		$this->fichierMoyenne['tmp_name'] = $tmp_name;
	}

	public function setFichierMoyenneError($error)
	{
		$this->fichierMoyenne['error'] = $error;
	}

	public function __toString( ): string
	{
		return "Import : annee=$this->annee, semestre=$this->semestre, estAlternance=$this->estAlternance, fichierJury=$this->fichierJury, fichierMoyenne=$this->fichierMoyenne";
	}
}

?>
