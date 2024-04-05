<?php
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	require_once "ControleurDB.inc.php";

	include_once 'ControleurImportation.php';
	include_once '../metier/importation/Import.inc.php';
	
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
			// $test = $this->DB->selectJoin(array('Etudiant', 'EtudiantSemestre', 'Cursus', 'CompetenceMatiere'), 'EtudiantCursusFetch', 'numsemestre', $numSemestre, 'codenip', 8847, 'annee', $annee);
			// $test = $this->DB->selectJoin(array('Cursus', 'CompetenceMatiere'), 'CursusFetch', 'numsemestre', $numSemestre, 'codenip', 1001);
			// var_dump($test);
			// return "";
			$lstCursus = $this->DB->selectAllWherePrecis (true, 'codenip', "Cursus", 'numsemestre', $numSemestre, 'AND', 'annee', $annee );
			//var_dump($lstCodeNIP);
			// $lstEtudiant = $this->DB->selectAllWhere ( "Etudiant", 'SPLIT_PART(promotion, \'-\', 2)', $anneeSortie );
			$tabDonnees = array();
			// echo 'testDehors';
			foreach ( $lstCursus as $cursusEtd )
			{
				// echo 'testDedans';
				$codenip = $cursusEtd->getCodeNIP ( );
				

				foreach ( $this->DB->selectJoin(array('Etudiant', 'EtudiantSemestre', 'Cursus', 'CompetenceMatiere', 'EstNote'), 'EtudiantCursusFetch', 'numsemestre', $numSemestre, 'codenip', $codenip, 'annee', $annee) as $etudcursusfetch )
				{
					// var_dump($etudcursusfetch);
					// echo 'testTEST';
					// Informations de la table Etudiant
					$etudiantDetails = array
					(
						'nom'          => $etudcursusfetch->nom       ,
						'prenom'       => $etudcursusfetch->prenom    ,
						'codeNIP'      => $codenip                    ,
						'parcours'     => $etudcursusfetch->parcours  ,
						'promotion'    => $etudcursusfetch->promotion ,
						'specialite'   => $etudcursusfetch->specialite,
						'typeBac'      => $etudcursusfetch->typebac
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
		
					$etudsemDetails = array
					(
						'rang'      => $etudcursusfetch->rang ,
						'nbAbsence' => $etudcursusfetch->nbabs,
						'passage'   => $etudcursusfetch->passage
					);
		
					$etudiantDetails [ 'etudsem' ] = $etudsemDetails;

		
					$cursusDetails = array ( );
					// Informations de la table Cursus
					foreach ( $etudcursusfetch->tabCursus as $cursusfetch )
					{
						$compmatDetails    = array ( );
						$matiereCompetence = array ( );

						//FIXME:

		
						// Informations de la table EstNote
						//FIXME: foreach inutile ?????????? (ptete pas enft sinon ça met des null)
						// var_dump($cursusfetch->tabMatiere);
						foreach ( $cursusfetch->tabMatiere as $matiere )
						{
							// echo '<br>TEST<br>';
							// var_dump($matiere);

							$matDetails = array
							(
								'libelle' => $matiere['libelle'],
								'coef'    => $matiere['coeff'],
								'moyenne' => $matiere['moyenne']
							);

							// foreach ( $this->DB->selectAllWhere ('EstNote', 'codenip', $codenip, 'AND', 'idmatiere', $matiere['libelle'] ) as $moyMat )
							// {
							// 	$matDetails [ 'moyenne' ] = $moyMat->getMoyenne ( );
							// }
							$matiereCompetence [ ] = $matDetails;
						}
						
		
						$compmatDetails [ 'matieres' ]  = $matiereCompetence;
						$compmatDetails [ 'admission' ] = $cursusfetch->admission;
						$cursusDetails [ $cursusfetch->idcompetence ] = $compmatDetails ;
						// $cursus->getidCompetence ( )
						$etudiantDetails [ 'cursus' ] = $cursusDetails;
					}

					
		
					// Informations de la table FPE
					foreach ( $this->DB->selectAllWhere ('FPE', 'codenip', $codenip ) as $fpe )
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
			$tabDonnees = $this->getJsonExporterTab($this->DB->selectAllWhere ( "Etudiant", 'SPLIT_PART(promotion, \'-\', 2)', $anneeSortie ));
			
			foreach ($this->getJsonExporterTab($this->DB->selectAllWhere ( "Etudiant", 'CAST(SPLIT_PART(promotion, \'-\', 2) AS INTEGER) - 1', $anneeSortie )) as $donnee)
			{
				$tabDonnees[] = $donnee;
			}

			foreach ($this->getJsonExporterTab($this->DB->selectAllWhere ( "Etudiant", 'CAST(SPLIT_PART(promotion, \'-\', 2) AS INTEGER) - 1', $anneeSortie )) as $donnee)
			{
				$tabDonnees[] = $donnee;
			}

			return json_encode($tabDonnees);
		}

		private function getJsonExporterTab($lstEtudiant)
		{
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

			return $tabDonnees;
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

			if (isset($_FILES['fichierCoeff']))
			{
				$tabImports['fichierCoeff'] = $_FILES['fichierCoeff'];
			}

			//TODO: tabImport[fichierImport] = _FILES[fichierImport]
			//print_r($tabImports);

			//TODO: faire appel à la méthode qui importe dans la bado
			importerAvecTableau ( $tabImports );
		}

		public function exportAvis()
		{
			$chefDept         = $_POST ['chefDept'        ];
			$fichierLogoUn    = $_FILES['fichierLogoUn'   ];
			$fichierLogoDeux  = $_FILES['fichierLogoDeux' ];
			$fichierSignature = $_FILES['fichierSignature'];
		}

		public function exportJury()
		{
			$promotion = $_POST ['promotion'       ];
			$semestre  = $_POST ['semestre'        ];

			// echo "promo : $promotion annee : $semestre";

			//TODO: appeler une fonction pour générer l'export jury
		}
	}

	$controleurVue = new ControleurVue();
	
	if (isset($_GET['numSemestre']) && !empty($_GET['numSemestre']) && isset($_GET['annee']) && !empty ($_GET['annee']))
	{
		$numSem = $_GET['numSemestre'];
		$annee = $_GET['annee'];

		//TODO: remettre juste ça
		echo $controleurVue->getJsonVisualiser($numSem, $annee);
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
	/*else
	{
		echo json_encode(['erreur' => 'ID de semestre ou annee manquant']);
	}*/

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

	if ($_SERVER["REQUEST_METHOD"] === "POST")
	{
		if (isset($_POST['annee']))
		{
			$controleurVue->import();
			echo json_encode(['succes' => 'Fichiers transmis']);
		}

		if (isset($_POST['chefDept']))
		{
			$controleurVue->exportAvis();
			echo json_encode(['succes' => 'Fichiers transmis']);
		}

		if (isset($_POST['promotion']) && isset($_POST['semestre']))
		{
			$controleurVue->exportJury();
			echo json_encode(['succes' => 'Fichiers transmis']);
		}
	}
?>