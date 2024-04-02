<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require "ControleurDB.inc.php";

	class ControleurVue
	{
		private $DB;

		public function __construct ( )
		{
			$this->DB = DB::getInstance ( );
			$retour = $this->DB->selectAll ( "Etudiant" );

			$tabDonnees = array();
			
			foreach ( $retour as $etudiant )
			{
				$codenip = $etudiant->getNIP();

				// Informations de la table Etudiant
				$etudiantDetails = array
				(
					'nom'          => $etudiant->getNom            ( ),
					'prenom'       => $etudiant->getPrenom         ( ),
					'codeNIP'      => $codenip                        ,
					'parcours'     => $etudiant->getParcours       ( ),
					'promotion'    => $etudiant->getPromotion      ( ),
					// 'illustration' => $etudiant->getidillustration ( )
				);

				echo "idEtude : " . $etudiant->getIdEtude();

				// Informations de la table Etude
				foreach ( $this->DB->selectAllWhere ( 'Etude', 'idetude', $etudiant->getIdEtude ( ) ) as $etude )
				{
					$etudeDetails = array
					(
						'specialite' => $etude->getSpecialite ( ),
						'typeBac'    => $etude->getTypeBac    ( )
					);

					$etudiantDetails [ 'etude' ] = $etudeDetails;
				}

				// Information de la table EtudiantSemestre
				foreach ( $this->DB->selectAllWhere ( 'EtudiantSemestre', 'codenip', $codenip ) as $etudesem )
				{
					$etudsemDetails = array
					(
						'rang'      => $etudesem->getRang       ( ),
						'nbAbsence' => $etudesem->getNbAbsences ( ),
						'passage'   => $etudesem->getPassage    ( )
					);

					$etudiantDetails [ 'etudsem' ] = $etudsemDetails;
				}

				// Informations de la table Cursus
				foreach ( $this->DB->selectAllWhere ( 'Cursus', 'codenip', $codenip ) as $cursus )
				{
					$cursusDetails = array
					(
						'admission' => $cursus->getAdmission ( ),
					);

					// Informations de la table CompetenceMatiere
					foreach ( $this->DB->selectAllWhere ( 'CompetenceMatiere', 'idcompetence', $cursus->getidCompetence ( ) ) as $compmat )
					{
						$compmatDetails = array
						(
							'libelle' => $compmat->getidMatiere ( ),
							'coef'    => $compmat->getCoeff ( )
						);

						$cursusDetails [ ] = $compmatDetails;
					}

					$etudiantDetails [ 'cursus' ] = $cursusDetails;
				}

				// Informations de la table estNote

				// Informations de la table FPE

				$tabDonnees [ ] = $etudiantDetails;
			}

			$json = json_encode( $tabDonnees );

			echo "JASON : " . $json;
		}
	}

	new ControleurVue();
?>