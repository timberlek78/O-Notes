<?php
	class Competence
	{
		//clé primaire
		private int $numcompt;

		//attributs
		private ?string $libelle;
		private $tabMatiere;
		private $db;

		public function __construct(?int $id = -1,  string $libelle="" )
		{
			$this->numcompt   = $id;
			$this->libelle    = $libelle;
			$this->db = DB::getInstance();
		}
		public function getAttributs() : array
		{
			return get_object_vars($this);
		}

		public function getId(): int
		{
			return $this->numcompt;
		}

		public function getLibelle(): string
		{
			return $this->libelle;
		}

		private function setId( int $id ): void
		{
			$this->id = $id;
		}

		public function setLibelle( string $libelle ): void
		{
			$this->libelle = $libelle;
		}
	}
?>