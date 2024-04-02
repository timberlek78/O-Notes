<?php

class FPE {
	private $idfpe;
	private $avismaster;
	private $avisecoleinge;
	private $commentaire;
	private $codenip;

	public function __construct($idFPE, $AvisMaster, $AvisEcoleInge, $commentaire, $codeNIP) {
		$this->idfpe = $idFPE;
		$this->avismaster = $AvisMaster;
		$this->avisecoleinge = $AvisEcoleInge;
		$this->commentaire = $commentaire;
		$this->codenip = $codeNIP;
	}


	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getIdFPE() {
		return $this->idfpe;
	}

	public function setIdFPE($idFPE) {
		$this->idfpe = $idFPE;
	}

	public function getAvisMaster() {
		return $this->avismaster;
	}

	public function setAvisMaster($AvisMaster) {
		$this->avismaster = $AvisMaster;
	}

	public function getAvisEcoleInge() {
		return $this->avisecoleinge;
	}

	public function setAvisEcoleInge($AvisEcoleInge) {
		$this->avisecoleinge = $AvisEcoleInge;
	}

	public function getCommentaire() {
		return $this->commentaire;
	}

	public function setCommentaire($commentaire) {
		$this->commentaire = $commentaire;
	}

	public function getCodeNIP() {
		return $this->codenip;
	}

	public function setCodeNIP($codeNIP) {
		$this->codenip = $codeNIP;
	}
}

?>
