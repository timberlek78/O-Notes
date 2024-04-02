<?php
	
	include '../controleur/ControleurDB.inc.php';
	include '../donnee/Competence.inc.php';
	include '../donnee/CompetenceMatiere.inc.php';
	include '../donnee/Cursus.inc.php';



class ONote
{
	private $ensCompetence, $ensCompetenceMatiere, $ensCursus, $ensEtude, $ensEtudiant, $ensEtudiantSemestre, $ensFPE, $ensIllustration, $ensMatiere, $ensPossede, $ensSemestre, $ensUtilisateur,$ensEstNote;

	public function __construct()
	{
		$db = DB::getInstance();
		$this->ensCompetence        = $db->selectAll('Competence');
		$this->ensCompetenceMatiere = $db->selectAll('CompetenceMatiere');
		$this->ensCursus            = $db->selectAll("Cursus"           );
		$this->ensEtude             = $db->selectAll("Etude"            );
		$this->ensEtudiant          = $db->selectAll("Etudiant"         );
		$this->ensEtudiantSemestre  = $db->selectAll("EtudiantSemestre" );
		$this->ensFPE               = $db->selectAll("FPE"              );
		$this->ensIllustration      = $db->selectAll("Illustration"     );
		$this->ensMatiere           = $db->selectAll("Matiere"          );
		$this->ensPossede           = $db->selectAll("Possede"          );
		$this->ensSemestre          = $db->selectAll("Semestre"         );
		$this->ensUtilisateur       = $db->selectAll("Utilisateur"      );
		$this->ensEstNote           = $db->selectAll("EstNote"          );

		$this->attribuerMatiereCompetence($this->ensCompetence);
		$this->attribuerMoyenneEtudiant  ($this->ensEtudiant  );
	} 

	// Getters
	public function getEnsCompetence       () : array { return $this->ensCompetence;        }
	public function getEnsCompetenceMatiere() : array { return $this->ensCompetenceMatiere; }
	public function getEnsCursus           () : array { return $this->ensCursus;            }
	public function getEnsEtude            () : array { return $this->ensEtude;             }
	public function getEnsEtudiant         () : array { return $this->ensEtudiant;          }
	public function getEnsEtudiantSemestre () : array { return $this->ensEtudiantSemestre;  }
	public function getEnsFPE              () : array { return $this->ensFPE;               }
	public function getEnsIllustration     () : array { return $this->ensIllustration;      }
	public function getEnsMatiere          () : array { return $this->ensMatiere;           }
	public function getEnsPossede          () : array { return $this->ensPossede;           }
	public function getEnsSemestre         () : array { return $this->ensSemestre;          }
	public function getEnsUtilisateur      () : array { return $this->ensUtilisateur;       }
	public function getEnsEstNote          () : array { return $this->ensEstNote;           }

	private function attribuerMoyenneEtudiant($tab)
	{
		foreach ($tab as $index => $etudiant) 
		{
			$etudiant->setTabMoyenne($this->determinerMoyenneCompetenceEtudiant($etudiant->getId()));
			$etudiant->calculeMoyenneG();
			$etudiant->determinerUe   ();
		}
	}

	private function attribuerMatiereCompetence($tab)
	{
		foreach($tab as $competence)
		{
			$competence->setTabMatieres($this->getTabMatiere($competence->getId()));
		}
	}

	public function determinerMoyenneCompetenceEtudiant($id) //determine le tab des moyennes de l'étudiant paser en parametre
	{
		$tab = $this->getEnsCursus();
		$tabMoyenne = array();
		for($i = 0; $i<count($tab); $i++) // Parcours de la table Cursus
			if($tab[$i]->getCodeNIP() == $id)
			{
				$somme      = 0;
				$competence = $this->selectById($tab[$i]->getIdCompetence(), $this->getEnsCompetence());
				$tabMatiere = $competence->getTabMatieres();

				var_dump($tabMatiere);
				
				for($j = 0; $j<count($tabMatiere); $j++) $somme += $this->selectMoyenneParEtudiant($tab[$i]->getId(), $id);

				$tabMoyenne[$competence->getId()] = $somme / count($tabMatiere);
			}

		var_dump($tabMoyenne);
		return $tabMoyenne;
	}

	public function determinerTabCompetence($idEtudiant) {
		$tabResultat = array(); 
		$tabSemestre = $this->determinerSemestre($idEtudiant);
		$anneeBUT = 1;
		
		foreach($tabSemestre as $semestre) {
			$tabCompetence = $this->determinerCompetence($semestre->getNumSemestre(), $idEtudiant);
			
			foreach($tabCompetence as $competence) {
				$tabTemp[$competence->getId()] = $competence->getAdmission();
			}
			
			if($semestre->getNumSemestre() % 2 == 0) {
				$tabResultat['BUT'.$anneeBUT] = $tabTemp;
				$anneeBUT++;
			}
		}
		
		return $tabResultat;
	}
	
	public function determinerSemestre($idEtudiant) {
		$tabSemestre = array(); 
		$tabCursus = $this->getEnsCursus();
		
		foreach($tabCursus as $cursus) {
			if($cursus->getIdEtudiant() == $idEtudiant) {
				$tabSemestre[$cursus->getNumSemestre()] = $cursus->getNumSemestre();
			}
		}
		
		return $tabSemestre;
	}
	
	public function determinerCompetence($numSemestre, $idEtudiant) {
		$tabCompetence = array();
		$tabCursus = $this->getEnsCursus();
		
		foreach($tabCursus as $cursus) {
			if($cursus->getNumSemestre() == $numSemestre && $cursus->getIdEtudiant() == $idEtudiant) {
				$tabCompetence[$cursus->getIdCompetence()] = $cursus->getIdCompetence();
			}
		}
		
		return $tabCompetence;
	}
	
	/***************************/
	/*  Méthode de recherche   */
	/***************************/

	public function getTabMatiere($id) : array
	{
		$taille     = count($this->getEnsCompetenceMatiere());
		$tab        =       $this->getEnsCompetenceMatiere();
		$tabMatiere = array();
		
		for($i = 0;$i<$taille;$i++)
		{
			echo "<br>";
			echo "\$tab[\$i]->getIdCompetence()" . $tab[$i]->getIdCompetence();
			echo "<br>\$id".$id;
			echo "<br>";
			if($tab[$i]->getIdCompetence() == $id)
			{
				

				echo "--------------";
				echo "\$tab[\$i]->getIdMatiere() : ".$tab[$i]->getIdMatiere();
				//var_dump($this->selectById($tab[$i]->getIdMatiere(), $this->getEnsMatiere()));
				$tabMatiere[] = $this->selectById($tab[$i]->getIdMatiere(), $this->getEnsMatiere());
			}
		}

		return $tabMatiere;
	}

	public function selectAdmis($Competence, $idEtudiant, $idSemestre) : string
	{
		$tab = $this->getEnsCursus();
		for( $i = 0; $i < count($tab); $i++)
		{
			if($tab[$i]->getIdCompetence() == $Competence->getIdCompetence() && $tab[$i]->getIdEtudiant() == $idEtudiant && $tab[$i]->getNumSemestre() == $idSemestre)
			{
				return $tab[$i]->getAdmission();
			}
		}

		return "";
	}

	public function selectMoyenneParEtudiant($idMatiere, $idEtudiant)
	{
		foreach($this->getEnsEstNote() as $estNote)
		{
			if($estNote->getCodeNip() == $idEtudiant && $estNote->getIdMatiere() == $idMatiere)
			{
				return $estNote->getMoyenne();
			}
		}
	}

	public function selectById($id, $tab)
	{
		$taille = count( $tab );

		var_dump($tab);

		for($i = 0; $i<$taille;$i++) if($tab[$i]->getId() == $id) return $tab[$i];
	}


}
?>
