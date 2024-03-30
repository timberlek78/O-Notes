<?php
	class Matiere
	{
		//clé primaire
		private int $nummatiere;

		//attributs
		private ?float  $moyenne;
		private ?int    $coeff;
		private ?bool   $alternant;
		private ?string $libelle;

		public function __construct( float $moyenne=-1.0, int $coeff=-1, bool $alternant=false, string $libelle="" )
		{
			$this->moyenne      = $moyenne;
			$this->coeff     = $coeff;
			$this->alternant = $alternant;
			$this->libelle   = $libelle;
		}
		public function getAttributs() : array
		{
			return get_object_vars($this);
		}

		public function getId(): int
		{
			return $this->nummatiere;
		}
		public function getmoyenne(): float
		{
			return $this->moyenne;
		}

		public function getCoeff(): int
		{
			return $this->coeff;
		}

		public function getAlternant(): bool
		{
			return $this->alternant;
		}

		public function getLibelle(): string
		{
			return $this->libelle;
		}

		private function setnummatiere( int $nummatiere ): void
		{
			$this->nummatiere = $nummatiere;
		}

		public function setmoyenne( float $moyenne ): void
		{
			$this->moyenne = $moyenne;
		}

		public function setCoeff( int $coeff ): void
		{
			$this->coeff = $coeff;
		}

		public function setAlternant( bool $alternant ): void
		{
			$this->alternant = $alternant;
		}

		public function setLibelle( string $libelle ): void
		{
			$this->libelle = $libelle;
		}
	}
?>