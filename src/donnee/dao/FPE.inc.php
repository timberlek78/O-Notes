<?php

require_once "ObjetDAO.inc.php";

class FPE extends ObjetDAO
{
	//clé primaire
	private $idfpe;

	//attributs
	private $avismaster;
	private $avisecoleinge;
	private $commentaire;
	private $codenip;

	public function __construct ( $idfpe=-1, $avismaster="", $avisecoleinge="", $commentaire="", $codenip=-1 )
	{
		$this->idfpe         = $idfpe;
		$this->avismaster    = $avismaster;
		$this->avisecoleinge = $avisecoleinge;
		$this->commentaire   = $commentaire;
		$this->codenip       = $codenip;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array ( "idfpe" => $this->idfpe );
	}

	public function getEqAttributs ( ) : array
	{
		return array ( "idfpe"         => $this->idfpe,
					   "avismaster"    => $this->avismaster,
					   "avisecoleinge" => $this->avisecoleinge,
					   "commentaire"   => $this->commentaire,
					   "codenip"       => $this->codenip );
	}

	public function getIdFPE ( )
	{
		return $this->idfpe;
	}

	public function setIdFPE ( $idfpe )
	{
		$this->idfpe = $idfpe;
	}

	public function getAvisMaster ( )
	{
		return $this->avismaster;
	}

	public function setAvisMaster ( $AvisMaster )
	{
		$this->avismaster = $AvisMaster;
	}

	public function getAvisEcoleInge ( )
	{
		return $this->avisecoleinge;
	}

	public function setAvisEcoleInge ( $AvisEcoleInge )
	{
		$this->avisecoleinge = $AvisEcoleInge;
	}

	public function getCommentaire ( )
	{
		return $this->commentaire;
	}

	public function setCommentaire ( $commentaire )
	{
		$this->commentaire = $commentaire;
	}

	public function getCodeNIP ( )
	{
		return $this->codenip;
	}

	public function setCodeNIP ( $codeNIP )
	{
		$this->codenip = $codeNIP;
	}
}
?>
