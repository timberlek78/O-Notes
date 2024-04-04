<?php

class ConfigFPE {
	private $idconfigfpe;
	private $nomdirecteur;
	private $anneepromo;

	public function __construct($idConfigFPE, $nomDirecteur, $anneePromo) {
		$this->idconfigfpe = $idConfigFPE;
		$this->nomdirecteur = $nomDirecteur;
		$this->anneepromo = $anneePromo;
	}

	public function getEqClesPrimaires() : array
	{
		return array("idconfigfpe" => $this->idconfigfpe);
	}

	public function getEqAttributs() : array
	{
		return array("idconfigfpe"  => $this->idconfigfpe,
					 "nomdirecteur" => $this->nomdirecteur,
					 "anneepromo"   => $this->anneepromo);
	}

	public function getIdConfigFPE()
	{
		return $this->idconfigfpe;
	}

	public function setIdConfigFPE($idConfigFPE)
	{
		$this->idconfigfpe = $idConfigFPE;
	}

	public function getNomDirecteur()
	{
		return $this->nomdirecteur;
	}

	public function setNomDirecteur($nomDirecteur)
	{
		$this->nomdirecteur = $nomDirecteur;
	}

	public function getAnneePromo()
	{
		return $this->anneepromo;
	}

	public function setAnneePromo($anneePromo)
	{
		$this->anneepromo = $anneePromo;
	}

	public function __toString()
	{
		return "ConfigFPE : idconfigfpe = " . $this->idconfigfpe . ", nomdirecteur = " . $this->nomdirecteur . ", anneepromo = " . $this->anneepromo;
	}

	//TODO: probablement un meilleur equals
	/*public function equals( ConfigFPE $configFPE ) : bool
	{
		$sontEgaux = false;

		foreach( $this->getEqClesPrimaires() as $cle => $valeur )
		{
			$sontEgaux = $sontEgaux && $valeur == $configFPE->getAttributs()[$cle];
		}

		return $sontEgaux;
	}*/

	public function equals( ConfigFPE $configFPE ) : bool
	{
		return $this->idconfigfpe == $configFPE->getIdConfigFPE();
	}
}

?>
