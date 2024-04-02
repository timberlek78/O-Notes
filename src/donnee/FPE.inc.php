<?php

class FPE {
	private $idFPE;
	private $AvisMaster;
	private $AvisEcoleInge;
	private $commentaire;
	private $codeNIP;

	public function __construct($idFPE, $AvisMaster, $AvisEcoleInge, $commentaire, $codeNIP) {
		$this->idFPE = $idFPE;
		$this->AvisMaster = $AvisMaster;
		$this->AvisEcoleInge = $AvisEcoleInge;
		$this->commentaire = $commentaire;
		$this->codeNIP = $codeNIP;
	}


	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getIdFPE() {
		return $this->idFPE;
	}

	public function setIdFPE($idFPE) {
		$this->idFPE = $idFPE;
	}

	public function getAvisMaster() {
		return $this->AvisMaster;
	}

	public function setAvisMaster($AvisMaster) {
		$this->AvisMaster = $AvisMaster;
	}

	public function getAvisEcoleInge() {
		return $this->AvisEcoleInge;
	}

	public function setAvisEcoleInge($AvisEcoleInge) {
		$this->AvisEcoleInge = $AvisEcoleInge;
	}

	public function getCommentaire() {
		return $this->commentaire;
	}

	public function setCommentaire($commentaire) {
		$this->commentaire = $commentaire;
	}

	public function getCodeNIP() {
		return $this->codeNIP;
	}

	public function setCodeNIP($codeNIP) {
		$this->codeNIP = $codeNIP;
	}
}

?>
