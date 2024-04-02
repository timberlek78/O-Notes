<?php

	class Competence
	{
		//clé primaire
		private string $idcompetence;

		//attributs
		private ?string $annee;

		private $tabMatiere;

		public function __construct( string $idcompetence="",string $annee="")
		{
			$this->idCompetence = $idcompetence;
			$this->annee        = $annee;
		}
		public function getAttributs() : array
		{
			return get_object_vars($this);
		}

		public function getId(): string { return $this->idcompetence;}
		public function getAnnee  () : string { return $this->annee;  }

		public function setIdCompetence( string $idcompetence ) { $this->idcompetence = $idcompetence;}
		public function setAnnee  ( string $annee   ) { $this->annee   = $annee;  }

		public function getTabMatieres() : array
		{
			return $this->tabMatiere;
		}

		public function setTabMatieres($tab)
		{
			echo "<br>bah je suis dans setTabMatiere <br>";

			var_dump($tab);
			$this->tabMatiere = $tab;
		}
	}
?>