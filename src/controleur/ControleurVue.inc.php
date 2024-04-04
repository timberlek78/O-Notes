<?php
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	require "ControleurDB.inc.php";

	include ('../metier/importation/Import.inc.php');
	
	header('Content-Type: application/json');

	class ControleurVue
	{
		private $DB;

		public function __construct ( )
		{
			$this->DB = DB::getInstance ( );
		}

		public function getJsonVisualiser($numSemestre, $annee) : string
		{
			$lstCursus = $this->DB->selectAllWherePrecis (true, 'codenip', "Cursus", 'numsemestre', $numSemestre, 'AND', 'annee', $annee );
			//var_dump($lstCodeNIP);
			// $lstEtudiant = $this->DB->selectAllWhere ( "Etudiant", 'SPLIT_PART(promotion, \'-\', 2)', $anneeSortie );
			$tabDonnees = array();
			
			foreach ( $lstCursus as $cursusEtd )
			{
				$codenip = $cursusEtd->getCodeNIP ( );
				

				foreach ( $this->DB->selectAllWhere('Etudiant', 'codenip', $codenip) as $etudiant )
				{
		
					// Informations de la table Etudiant
					$etudiantDetails = array
					(
						'nom'          => $etudiant->getNom            ( ),
						'prenom'       => $etudiant->getPrenom         ( ),
						'codeNIP'      => $codenip                        ,
						'parcours'     => $etudiant->getParcours       ( ),
						'promotion'    => $etudiant->getPromotion      ( ),
						'specialite'   => $etudiant->getSpecialite     ( ),
						'typeBac'      => $etudiant->getTypeBac        ( )
					);
			
					// Informations de la table Etude
					// foreach ( $this->DB->selectAllWhere ( 'Etude', 'idetude', $etudiant->getIdEtude ( ) ) as $etude )
					// {
					// 	$etudeDetails = array
					// 	(
					// 		'specialite' => $etude->getSpecialite ( ),
					// 		'typeBac'    => $etude->getTypeBac    ( )
					// 	);
		
					// 	$etudiantDetails [ 'etude' ] = $etudeDetails;
					// }
		
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
					foreach ( $this->DB->selectAllWhere ( 'Cursus', 'codenip', $codenip, 'AND', 'numSemestre', $numSemestre) as $cursus )
					{
						$compmatDetails    = array ( );
						$matiereCompetence = array ( );

						// Informations de la table CompetenceMatiere
						foreach ( $this->DB->selectAllWhere ( 'CompetenceMatiere', 'idcompetence', $cursus->getidCompetence ( )) as $compmat )
						{
		
							$matDetails = array
							(
								'libelle' => $compmat->getidMatiere ( ),
								'coef'    => $compmat->getCoeff     ( )
							);
		
							// Informations de la table EstNote
							//FIXME: foreach inutile ?????????? (ptete pas enft sinon ça met des null)
							foreach ( $this->DB->selectAllWhere ( 'EstNote', 'codenip', $codenip, 'AND', 'idmatiere', $compmat->getidMatiere ( ) ) as $moyMat )
							{
								$matDetails [ 'moyenne' ] = $moyMat->getMoyenne ( );
							}
		
							$matiereCompetence [ ] = $matDetails;
						}
						
						$compmatDetails [ 'matieres' ]  = $matiereCompetence;
						$compmatDetails [ 'admission' ] = $cursus->getAdmission ( );
						$cursusDetails [ $cursus->getidCompetence ( ) ] = $compmatDetails ;
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
			}
	
			$json = json_encode( $tabDonnees );

			return $json;
		}

		public function getJsonExporter($annee) : string
		{
			$anneeSortie = substr($annee, 5, 4);
			$lstEtudiant = $this->DB->selectAllWhere ( "Etudiant", 'SPLIT_PART(promotion, \'-\', 2)', $anneeSortie );
			$tabDonnees = array ( );
				
			foreach ( $lstEtudiant as $etudiant )
			{
				$codenip = $etudiant->getCodeNIP ( );

				$etudiantDetails = array
				(
					'nom'          => $etudiant->getNom            ( ),
					'prenom'       => $etudiant->getPrenom         ( )
				);

				$fpeEtu = $this->DB->selectAllWhere( "FPE", 'codenip', $codenip );

				$etudiantDetails [ 'fpeRenseignee' ] = $fpeEtu != null;

				$tabDonnees [ ] = $etudiantDetails;
			}

			return json_encode ( $tabDonnees );
		}

		public function getJsonAnnee() : string
		{
			$lstAnnee = $this->DB->getAnneesRenseignees ( );

			$tabAnnee = array();
			
			foreach ($lstAnnee as $annee)
			{
				$tabAnnee [ ] = $annee->getAnnee();
			}
			
			return json_encode ( $tabAnnee );
		}

		public function traiterFichiersImportes($json)
		{
			$json = json_decode(file_get_contents('php://input'), true);
		}

		public function import()
		{
			$tabImports = array();
			foreach ($_POST['annee'] as $cle => $valeur)
			{
				$tabImports[] = new Import($valeur);
			}

			for ($cpt = 0 ; $cpt < count($tabImports) ; $cpt++)
			{
				$tabImports[$cpt]->setSemestre($_POST['semestre'][$cpt]);
			}

			for ($cpt = 0 ; $cpt < count ( $tabImports ) ; $cpt++)
			{
				$tabImports[ $cpt ]->setSemestre             ( $_POST  [ 'semestre'       ] [ $cpt      ]          );

				$tabImports[ $cpt ]->setFichierJuryType      ( $_FILES [ 'fichierJury'    ] [ 'type'    ] [ $cpt ] );
				$tabImports[ $cpt ]->setFichierJuryError     ( $_FILES [ 'fichierJury'    ] [ 'error'   ] [ $cpt ] );
				$tabImports[ $cpt ]->setFichierJuryTmpName   ( $_FILES [ 'fichierJury'    ] [ 'tmp_name'] [ $cpt ] );
				
				$tabImports[ $cpt ]->setFichierMoyenneType   ( $_FILES [ 'fichierMoyenne' ] [ 'type'    ] [ $cpt ] );
				$tabImports[ $cpt ]->setFichierMoyenneError  ( $_FILES [ 'fichierMoyenne' ] [ 'error'   ] [ $cpt ] );
				$tabImports[ $cpt ]->setFichierMoyenneTmpName( $_FILES [ 'fichierMoyenne' ] [ 'tmp_name'] [ $cpt ] );
			}

			print_r($tabImports);

			//TODO: faire appel à la méthode qui importe dans la bado
		}
	}

	$controleurVue = new ControleurVue();
	
	echo 'test';
	if (isset($_GET['numSemestre']) && !empty($_GET['numSemestre']) && isset($_GET['annee']) && !empty ($_GET['annee']))
	{
		$numSem = $_GET['numSemestre'];
		$annee = $_GET['annee'];

		$tempsDebut = microtime(true);
		$resultat =  $controleurVue->getJsonVisualiser($numSem, $annee);
		$tempsFin = microtime(true);

		$tempsExecution = $tempsFin - $tempsDebut;
		echo "<h1>Temps : $tempsExecution s</h1>";
		echo $resultat;
	}
	else if (isset($_GET['annee']) && !empty ($_GET['annee']))
	{
		$annee = $_GET['annee'];
		echo $controleurVue->getJsonExporter($annee);
	}
	else if (isset($_GET['anneesRenseignees']) && !empty ( $_GET [ 'anneesRenseignees']))
	{
		echo $controleurVue->getJsonAnnee ( );
	}
	else
	{
		echo json_encode(['erreur' => 'ID de semestre ou annee manquant']);
	}

	// if (isset($_POST['fichiersImportes']))
	// {
	// 	$jsonRecu = $_POST['fichiersImportes'];
	// 	$controleurVue->traiterFichiersImportes($jsonRecu);

	// 	$json = json_decode(file_get_contents('php://input'), true);
	// 	var_dump($_POST);
		
	// 	echo json_encode(['succes' => 'Fichiers transmis']);
	// }
	// else
	// {
	// 	echo json_encode(['error' => 'Aucun fichier envoyé ou informations manquantes.']);
	// }

	// if ($_FILES && isset($_FILES['fichier'])) {
	// 	$fichier = $_FILES['fichier'];
	// 	$nomFichier = $fichier['name'];
	// 	$fichierTemporaire = $fichier['tmp_name'];
	
	// 	// Traitez le fichier comme nécessaire
	// 	// Par exemple, affichez le nom du fichier
	// 	echo "Le fichier $nomFichier a été téléchargé avec succès.";
	// } else {
	// 	echo "Aucun fichier n'a été téléchargé.";
	// }

	if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['annee'])) //POST[annee][0] = "2002-2003" POST[annee][1]
	{
		$controleurVue->import();
	}
?>