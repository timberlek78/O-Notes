<?php

require_once "AnalyseDetailCompetencesMoyenne.inc.php";

class AnalyseStructureMoyennes
{
	private array $colonnesTitres;
	private int $nbColonnes;

	private array $eqColonnesIndices; //eq = equivalent
	private AnalyseDetailCompetencesMoyenne $analyseDetailCompetencesMoyenne;
	private array $eqColonnesMatieresIndices;

	public function __construct( array $colonnesTitres, int $semestre )
	{
		$this->colonnesTitres = $colonnesTitres;
		$this->nbColonnes = count( $colonnesTitres );

		$this->definirIndicesColonnesEtudiants( );
		$this->analyseDetailCompetencesMoyenne = new AnalyseDetailCompetencesMoyenne( $colonnesTitres, $semestre );

		$this->definirEquivalentIndiceMatieresDistinctes( $semestre );
	}

	private function definirIndicesColonnesEtudiants( )
	{
		for( $cptCol = 0; $cptCol < $this->nbColonnes; $cptCol++ )
		{
			$nomColonne = $this->colonnesTitres[ $cptCol ];
			if( self::estVide( $nomColonne ) )
			{
				continue;
			}

			switch( $nomColonne )
			{
				case "code_nip":
					$this->eqColonnesIndices[ "codeNIP" ] = $cptCol;
					break;
				case "Rg":
					$this->eqColonnesIndices[ "rang" ] = $cptCol;
					break;
				case "Nom":
					$this->eqColonnesIndices[ "nom" ] = $cptCol;
					break;
				case "Prénom":
					$this->eqColonnesIndices[ "prenom" ] = $cptCol;
					break;
				case "Cursus":
					$this->eqColonnesIndices[ "cursus" ] = $cptCol;
					break;
				case "Abs":
					$this->eqColonnesIndices[ "absTotal" ] = $cptCol;
					break;
				case "Just.":
					$this->eqColonnesIndices[ "absJust" ] = $cptCol;
					break;
				case "Bac":
					$this->eqColonnesIndices[ "typeBAC" ] = $cptCol;
					break;
				case "Spécialité":
					$this->eqColonnesIndices[ "specialite" ] = $cptCol;
					break;
				case "Parcours":
					$this->eqColonnesIndices[ "parcours" ] = $cptCol;
					break;
			}
		}
	}

	private function definirEquivalentIndiceMatieresDistinctes( int $semestre )
	{
		$this->eqColonnesMatieresIndices = array( );
		$indDebutCompetences = 0;
		$indFinCompetences   = $this->nbColonnes - 1;

		for( $cptCol = $indDebutCompetences; $cptCol <= $indFinCompetences; $cptCol++ )
		{
			$nomColonne = $this->colonnesTitres[ $cptCol ];
			if( self::estVide( $nomColonne ) )
			{
				continue;
			}

			$estPasCompetence = ! AnalyseDetailCompetencesMoyenne::estCompetence( $nomColonne, $semestre );
			$regexMatiere = "/BIN/";
			$estMatiere = preg_match( $regexMatiere, $nomColonne );
			$innexistante = ! array_key_exists( $nomColonne, $this->eqColonnesMatieresIndices );
			if( $estMatiere && $innexistante )
			{
				$this->eqColonnesMatieresIndices[ $nomColonne ] = $cptCol;
			}
		}
	}

	private static function estVide( string $nomColonne ) : bool
	{
		return $nomColonne == "";
	}

	public function getIndiceColonne( string $cle ) : ?int
	{
		$cleExiste = array_key_exists( $cle, $this->eqColonnesIndices );
		if( $cleExiste )
		{
			return $this->eqColonnesIndices[ $cle ];
		}
		else
		{
			return null;
		}
		
	}

	public function getCompetences( $semestre )
	{
		return $this->analyseDetailCompetencesMoyenne->getCompetences( $semestre );
	}

	public function getRessourcesCompetence( string $nomCompetence )
	{
		return $this->analyseDetailCompetencesMoyenne->getRessourcesCompetence( $nomCompetence );
	}

	public function getMatieresDistinctes( ) : array
	{
		return array_keys( $this->eqColonnesMatieresIndices );
	}

	public function getIndiceColonneMatiere( string $nomMatiere ) : int
	{
		return $this->eqColonnesMatieresIndices[ $nomMatiere ];
	}
}
?>