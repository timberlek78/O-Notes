<?php

	class Competence
	{
		//clé primaire
		private string $idCompetence;

		//attributs
		private ?string $annee;

		public function __construct( string $idCompetence="", $annee)
		{
			$this->idCompetence = $idCompetence;
			$this->annee   = $annee;
		}
		public function getAttributs() : array
		{
			return get_object_vars($this);
		}

		public function getIdCompetence() : string { return $this->idCompetence;}
		public function getAnnee  () : string { return $this->annee;  }

		public function setIdCompetence( string $idCompetence ) { $this->idCompetence = $idCompetence;}
		public function setAnnee  ( string $annee   ) { $this->annee   = $annee;  }
	}
?>