<?php

require_once 'AnalyseStructureJury.inc.php';
require_once __DIR__.'/../../../donnee/IncludeAll.php';

class AnalyseDataJury
{
	private array $tableau;
	private AnalyseStructureJury $structure;

	private int    $semestre;

	public function __construct( array $tableau, int $semestre )
	{
		$this->tableau = $tableau;
		$this->structure = new AnalyseStructureJury( $this->tableau[ 0 ], $semestre );
		
		$this->semestre = $semestre;
	}

	public function majPassageEtudiantSemestre( )
	{
		for( $cptEtudiant = 1; $cptEtudiant < count( $this->tableau ); $cptEtudiant++ )
		{
			$codeNIP = $this->tableau[ $cptEtudiant ][ $this->structure->getIndiceColonne( "codeNIP" ) ];
			$etudiant = FIND_ETUDIANT_BY_CODE_NIP( $codeNIP ); //FIXME: lier à la bd
			$idEtudiant = $etudiant->getId( );

			$idSemestre = FIND_ID_SEMESTRE( $this->semestre ); //FIXME: lier à la bd

			$etudiantSemestre = FIND_ETUDIANT_SEMESTRE_BY_IDS( $idEtudiant, $idSemestre ); //FIXME: lier à la bd
			$typeAdmission = $this->tableau[ $cptEtudiant ][ $this->structure->getIndiceColonne( "passage" ) ];
			$etudiantSemestre->setPassage( $typeAdmission );
		}
	}

	public function majAdmissionCursus( Cursus $cursus )
	{
		for( $cptEtudiant = 1; $cptEtudiant < count( $this->tableau ); $cptEtudiant++ )
		{
			$codeNIP = $this->tableau[ $cptEtudiant ][ $this->structure->getIndiceColonne( "codeNIP" ) ];
			$etudiant = FIND_ETUDIANT_BY_CODE_NIP( $codeNIP ); //FIXME: lier à la bd
			$idEtudiant = $etudiant->getId( );

			$idSemestre = FIND_ID_SEMESTRE( $this->semestre ); //FIXME: lier à la bd

			//parcourir les compétences
			$ensNomCompetences = $this->structure->getCompetences( $this->semestre );
			foreach( $ensNomCompetences as $nomCompetence )
			{
				$admission = $this->tableau[ $cptEtudiant ][ $this->structure->getIndiceColonne( $nomCompetence ) ];
				$competence = FIND_COMPETENCE_BY_NOM( $nomCompetence ); //FIXME: lier à la bd
				$idCompetence = $competence->getId( );

				$cursus = FIND_CURSUS_BY_IDS( $idEtudiant, $idSemestre, $idCompetence ); //FIXME: lier à la bd
				$cursus->setAdmission( $admission );
			}
		}
	}
}
?>