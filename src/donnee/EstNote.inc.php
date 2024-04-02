<?php

class EstNote 
{
    private $codenip;
    private $idmatiere;
    private $moyenne;

    public function __construct($codenip = -1, $idmatiere = "", $moyenne = -1) {
        $this->codenip = $codenip;
        $this->idmatiere = $idmatiere;
        $this->moyenne = $moyenne;
    }

    public function getCodeNip() {
        return $this->codenip;
    }

    public function setCodeNip($codenip) {
        $this->codenip = $codenip;
    }

    public function getIdMatiere() {
        return $this->idmatiere;
    }

    public function setIdMatiere($idmatiere) {
        $this->idmatiere = $idmatiere;
    }

    public function getMoyenne() {
        return $this->moyenne;
    }

    public function setMoyenne($moyenne) {
        $this->moyenne = $moyenne;
    }
}

?>
