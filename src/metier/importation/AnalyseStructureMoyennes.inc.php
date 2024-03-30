<?php
class AnalyseStructureMoyennes
{
	private array $colonnesTitres;
	private int $nbColonnes;

	private array $eqColonnesIndices; //eq = equivalent
	private array $eqCompetencesIndices;
	private array $eqRessourcesCompetencesIndices;

	function __construct( array $colonnesTitres, int $semestre )
	{
		$this->colonnesTitres = $colonnesTitres;
		$this->nbColonnes = count( $ligneTitres );

		$this->definirIndicesColonnesFixes( );
		$this->definirIndicesCompetences( $semestre );
	}

	private function definirIndicesColonnesFixes( )
	{
		$dernierIndice = $nbColonnes - 1;

		$this->eqColonnesIndices[ "codeNIP"    ] = 1;
		$this->eqColonnesIndices[ "rang"       ] = 2;
		$this->eqColonnesIndices[ "nom"        ] = 5;
		$this->eqColonnesIndices[ "prenom"     ] = 6;
		$this->eqColonnesIndices[ "cursus"     ] = 9;
		$this->eqColonnesIndices[ "absTotal"   ] = 12;
		$this->eqColonnesIndices[ "absJust"    ] = 13;
		$this->eqColonnesIndices[ "typeBAC"    ] = $dernierIndice - 3;
		$this->eqColonnesIndices[ "specialite" ] = $dernierIndice - 2;

		$this->eqColonnesIndices[ "debCompetences" ] = 14;
		$this->eqColonnesIndices[ "finCompetences" ] = $dernierIndice - 4;
	}

	private function definirIndicesCompetences( int $semestre )
	{
		$indDebut = $this->eqColonnesIndices[ "debCompetences" ];
		$indFin   = $this->eqColonnesIndices[ "finCompetences" ];

		for( $i = $indDebut; $i < $indFin + 1; $i++ )
		{
			$regexCompetence = "^BIN" . $semestre . "_$";
			$nomColonne = $this->colonnesTitres[ $i ];

			if( preg_match( $regexCompetence, $nomColonne ) )
			{
				$nomCompetence = $this->colonnesTitres[ $i ];
				$this->eqCompetencesIndices[ $nomCompetence ] = $i;
				definirIndicesRessourcesCompetence( $nomCompetence, $semestre );
			}
		}
	}

	private function definirIndicesRessourcesCompetence( string $nomCompetence, int $semestre )
	{
		$indDebut  = $this->eqCompetencesIndices[ $nomCompetence ];
		$indFinMax = $this->eqColonnesIndices[ "finCompetences" ];

		for( $i = $indDebut; $i < $indFin; $i++ )
		{
			//exemple : "Bonus BIN11" ou "BINR101" ou "BINS101"
			$regexBonus = "^Bonus " . $nomCompetence . "$";
			$regexRessource = "^BIN " . "[RS]" . $semestre . "[0-9]{2}$";

			boolean $estBonus = preg_match( $regexBonus, $this->colonnesTitres[ $i ] );
			boolean $estRessource = preg_match( $regexRessource, $this->colonnesTitres[ $i ] );
			if( $estBonus || $estRessource )
			{
				$nomRessource = $this->colonnesTitres[ $i ];
				$eqRessourcesCompetencesIndices[ $nomCompetence ][ $nomRessource ] = $i;
			}
		}
	}

	public function getIndiceColonne( string $cle ) : int
	{
		return $this->eqColonnesIndices[ $cle ];
	}

	public function getCompetences( ) : array
	{
		return array_keys( $this->eqCompetencesIndices );
	}

	public function getIndiceColonneCompetence( string $competence )
	{
		return $this->eqCompetencesIndices[ $competence ];
	}

	public function getRessourcesCompetences( string $nomCompetence ) : array
	{
		return array_keys( $this->eqRessourcesCompetencesIndices[ $nomCompetence ] );
	}

	public function getIndiceColonneRessourceCompetence( string $nomCompetence, string $nomRessource ) : int
	{
		return $this->eqRessourcesCompetencesIndices[ $nomCompetence ][ $nomRessource ];
	}
}
?>