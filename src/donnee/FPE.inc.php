<?php

class FPE {
	private $idfpe;
	private $AvisMaster;
	private $AvisEcoleInge;
	private $commentaire;
	private $codeNIP;

	public function __construct($idfpe = -1, $AvisMaster = "", $AvisEcoleInge = "", $commentaire ="", $codeNIP = -1) {
		$this->idfpe = $idfpe;
		$this->AvisMaster = $AvisMaster;
		$this->AvisEcoleInge = $AvisEcoleInge;
		$this->commentaire = $commentaire;
		$this->codeNIP = $codeNIP;
	}


	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getId() {
		return $this->idfpe;
	}

	public function setidfpe($idfpe) {
		$this->idfpe = $idfpe;
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
