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
		}

		public function getJsonVisualiser($numSemestre) : string
		{
			$lstEtudiant = $this->DB->selectAll ( "Etudiant" );
			$tabDonnees = array();
				
			foreach ( $lstEtudiant as $etudiant )
			{
				$codenip = $etudiant->getNIP ( );
	
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
	
				echo "idEtude : " . $etudiant->getIdEtude ( );
	
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
				foreach ( $this->DB->selectAllWhere ( 'EtudiantSemestre', 'codenip', $codenip, 'AND', 'numsemestre', $numSemestre ) as $etudesem )
				{
					$etudsemDetails = array
					(
						'rang'      => $etudesem->getRang       ( ),
						'nbAbsence' => $etudesem->getNbAbsences ( ),
						'passage'   => $etudesem->getPassage    ( )
					);
	
					$etudiantDetails [ 'etudsem' ] = $etudsemDetails;
				}
	
				$cursusDetails = array ( );
				// Informations de la table Cursus
				foreach ( $this->DB->selectAllWhere ( 'Cursus', 'codenip', $codenip ) as $cursus )
				{
					$compmatDetails    = array ( );
					$matiereCompetence = array ( );

					// Informations de la table CompetenceMatiere
					foreach ( $this->DB->selectAllWhere ( 'CompetenceMatiere', 'idcompetence', $cursus->getIdCompetence ( ) ) as $compmat )
					{
	
						$matDetails = array
						(
							'libelle' => $compmat->getIdMatiere ( ),
							'coef'    => $compmat->getCoeff     ( )
						);
	
						// Informations de la table EstNote
						//FIXME: foreach inutile ?????????? (ptete pas enft sinon ça met des null)
						foreach ( $this->DB->selectAllWhere ( 'EstNote', 'codenip', $codenip, 'AND', 'idmatiere', $compmat->getIdMatiere ( ) ) as $moyMat )
						{
							$matDetails [ 'moyenne' ] = $moyMat->getMoyenne ( );
						}
	
						$matiereCompetence [ ] = $matDetails;
					}
					
					$compmatDetails [ 'matieres' ]  = $matiereCompetence;
					$compmatDetails [ 'admission' ] = $cursus->getAdmission ( );
					$cursusDetails [ $cursus->getIdCompetence ( ) ] = $compmatDetails ;
	
					// $cursus->getidCompetence ( )
					$etudiantDetails [ 'cursus' ] = $cursusDetails;
				}
	
				// Informations de la table FPE
				foreach ( $this->DB->selectAllWhere ( 'FPE', 'codenip', $codenip ) as $fpe )
				{
					$fpeDetails = array
					(
						'avisMaster'    => $fpe->getAvisMaster    ( ),
						'avisEcoleInge' => $fpe->getAvisEcoleInge ( ),
						'commentaire'   => $fpe->getCommentaire   ( )
					);
	
					$etudiantDetails [ 'FPE' ] = $fpeDetails;
				}
	
				$tabDonnees [ ] = $etudiantDetails;
			}
	
			$json = json_encode( $tabDonnees );

			return $json;
		}

		public function getJsonExporter($annee) : string
		{
			$lstEtudiant = $this->DB->selectAll ( "Etudiant" );
			$tabDonnees = array ( );
				
			foreach ( $lstEtudiant as $etudiant )
			{
				$codenip = $etudiant->getNIP ( );

				$etudiantDetails = array
				(
					'nom'          => $etudiant->getNom            ( ),
					'prenom'       => $etudiant->getPrenom         ( )
				);

				$fpeEtu = $this->DB->selectAllWhere( "FPE", 'codenip', $codenip );

				$etudiantDetails [ 'fpeRenseignee' ] = $fpeEtu != null;

				$tabDonnees [ ] = $etudiantDetails;
			}

			return json_encode( $tabDonnees );
		}
	}

	$controleurVue = new ControleurVue();
	
	if (isset($_GET['numSemestre']) && !empty($_GET['numSemestre']))
	{
		$numSem = $_GET['numSemestre'];
		echo $controleurVue->getJsonVisualiser($numSem);
	}
	else if (isset($_GET['annee']) && !empty ($_GET['annee']))
	{
		$annee = $_GET['annee'];
		echo $controleurVue->getJsonExporter($annee);
	}
	else
	{
		echo json_encode(['erreur' => 'ID de semestre ou annee manquant']);
	}
?>