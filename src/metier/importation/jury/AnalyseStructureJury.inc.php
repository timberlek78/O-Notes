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

		$this->definirIndicesColonnesCompetences( );
	}

	private function definirIndicesColonnesCompetences( )
	{
		$this->indiceCodeNIP = 1;
		$this->indiceAdmission = $this->nbColonnes - 1 - 2;

		$regexCompetence = "/^BIN" . $semestre . "\d$/";
		for( $cptCol=0; $cptCol<$this->nbColonnes; $cptCol++ )
		{
			$colonne = $this->colonnesTitres[ $cptCol ];
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