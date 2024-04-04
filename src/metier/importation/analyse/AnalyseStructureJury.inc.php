<?php

class AnalyseStructureJury
{
	private array $colonnesTitres;
	private int $nbColonnes;

	private int $indiceCodeNIP;
	private int $indiceAdmission;
	
	private array $eqAdmissionsCompetenceIndices;

	public function __construct( array $colonnesTitres, int $semestre )
	{
		$this->colonnesTitres = $colonnesTitres;
		$this->nbColonnes = count( $colonnesTitres );

		$this->definirIndicesColonnesEtudiants( );
		$this->definirIndicesColonnesCompetences( $semestre );
	}

	private function definirIndicesColonnesEtudiants( )
	{
		$this->indiceCodeNIP = 1;
		$this->indiceAdmission = $this->nbColonnes - 1 - 1;
	}

	private function definirIndicesColonnesCompetences( int $semestre )
	{
		$regexCompetence = "/^BIN" . $semestre . "\dA?$/";
		for( $cptCol=0; $cptCol<$this->nbColonnes; $cptCol++ )
		{
			$colonne = $this->colonnesTitres[ $cptCol ];
			$estVide = $colonne == "";
			if( $estVide )
			{ 
				continue;
			}

			$estCompetence = preg_match( $regexCompetence, $colonne );
			if( $estCompetence )
			{
				$this->eqAdmissionsCompetenceIndices[ $colonne ] = $cptCol;
			}
		}
	}

	public function getIndiceColonne( string $cle ) : int
	{
		if( $cle == "codeNIP" )
		{
			return $this->indiceCodeNIP;
		}
		else if( $cle == "admission" )
		{
			return $this->indiceAdmission;
		}
		else
		{
			return $this->eqAdmissionsCompetenceIndices[ $cle ];
		}
	}

	public function getCompetences( $semestre )
	{
		return array_keys( $this->eqAdmissionsCompetenceIndices );
	}
}
?>