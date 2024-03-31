<?php

require_once "AnalyseDetailCompetencesMoyenne.inc.php";

class AnalyseStructureMoyennes
{
	private array $colonnesTitres;
	private int $nbColonnes;

	private array $eqColonnesIndices; //eq = equivalent
	private AnalyseDetailCompetencesMoyenne $analyseDetailCompetencesMoyenne;

	public function __construct( array $colonnesTitres, int $semestre )
	{
		$this->colonnesTitres = $colonnesTitres;
		$this->nbColonnes = count( $colonnesTitres );

		$this->definirIndicesColonnesFixes( );

		$colonnesDetailCompetences = $this->getArrayDetailCompetences( );
		$this->analyseDetailCompetencesMoyenne = new AnalyseDetailCompetencesMoyenne( $colonnesDetailCompetences, $semestre );
	}

	private function definirIndicesColonnesFixes( )
	{
		$dernierIndice = $this->nbColonnes - 1;

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

	private function getArrayDetailCompetences( ) : array
	{
		$indDebutCompetences = $this->getIndiceColonne( "debCompetences" );
		$indFinCompetences   = $this->getIndiceColonne( "finCompetences" );

		$nbColonnes = $indFinCompetences - $indDebutCompetences + 1;

		return array_slice( $this->colonnesTitres, $indDebutCompetences, $nbColonnes);
	}

	public function getIndiceColonne( string $cle ) : int
	{
		return $this->eqColonnesIndices[ $cle ];
	}

	public function getCompetences( $semestre )
	{
		return $this->analyseDetailCompetencesMoyenne->getCompetences( $semestre );
	}

	public function getRessourcesCompetence( string $nomCompetence )
	{
		return $this->analyseDetailCompetencesMoyenne->getRessourcesCompetence( $nomCompetence );
	}
}
?>