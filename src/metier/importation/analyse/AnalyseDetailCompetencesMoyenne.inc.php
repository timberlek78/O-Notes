<?php
class AnalyseDetailCompetencesMoyenne
{
	private array $colonnesDetailCompetences;
	private int $nbColonnes;

	private array $eqCompetencesIndices;
	private array $eqRessourcesCompetencesIndices;

	function __construct( array $colonnesDetailCompetences, int $semestre )
	{
		$this->colonnesDetailCompetences = $colonnesDetailCompetences;
		$this->nbColonnes = count( $colonnesDetailCompetences );

		$this->definirIndicesCompetences( $semestre );
	}

	private function definirIndicesCompetences( int $semestre )
	{
		for( $i = 0; $i < $this->nbColonnes; $i++ )
		{
			$nomColonne = $this->colonnesDetailCompetences[ $i ];

			if( AnalyseDetailCompetencesMoyenne::estCompetence( $nomColonne, $semestre ) )
			{
				$nomCompetence = $this->colonnesDetailCompetences[ $i ];
				$this->eqCompetencesIndices[ $nomCompetence ] = $i;
				$this->definirIndicesRessourcesCompetence( $nomCompetence, $i+1, $semestre );
			}
		}
	}

	public static function estCompetence( string $nomColonne, int $semestre ) : bool
	{
		$regexCompetence = "/^BIN" . $semestre . "\d$/"; //REMARQUE : dans php il faut préfixer par "/^" et suffixer par "$/"
		return preg_match( $regexCompetence, $nomColonne );
	}

	private function definirIndicesRessourcesCompetence( string $nomCompetence, int $indiceDebut, int $semestre )
	{
		for( $i = $indiceDebut; $i < $this->nbColonnes; $i++ )
		{
			//Des qu'on atteint une nouvelle competence, on sort
			if( AnalyseDetailCompetencesMoyenne::estCompetence( $this->colonnesDetailCompetences[ $i ], $semestre ) )
			{
				return;
			}

			if( AnalyseDetailCompetencesMoyenne::estRessource( $this->colonnesDetailCompetences[ $i ], $nomCompetence, $semestre ) )
			{
				$nomRessource = $this->colonnesDetailCompetences[ $i ];
				$this->eqRessourcesCompetencesIndices[ $nomCompetence ][ $nomRessource ] = $i;
			}
		}
	}

	public static function estRessource( string $nomColonne, string $nomCompetence, int $semestre ) : bool
	{
		//exemple : "Bonus BIN11" ou "BINR101" ou "BINS101"
		$regexBonus = "/^Bonus " . $nomCompetence . "$/";
		$regexRessource = "/^BIN" . "[RS]" . $semestre . "\d\d$/";

		$estBonus = preg_match( $regexBonus, $nomColonne );
		$estRessource = preg_match( $regexRessource, $nomColonne );

		return $estBonus || $estRessource;
	}

	public function getCompetences( int $semestre ) : array
	{
		return array_keys( $this->eqCompetencesIndices );
	}

	public function getRessourcesCompetence( string $nomCompetence ) : array
	{
		return array_keys( $this->eqRessourcesCompetencesIndices[ $nomCompetence ] );
	}
}
?>