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
		$this->ensEstNote           = $db->selectAll('EstNote'          );

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
			$etudiant->setTabCursus ($this->determinerTabCompetence            ($etudiant->getId()));
			$etudiant->calculeMoyenneG();
			$etudiant->determinerUe   ();
		}
	}

	private function attribuerMatiereCompetence($tab)
	{
		foreach($tab as $competence)
		{
			$competence->setTabMatieres($this->getTabMatiere($competence->getId(), $competence->getAnnee()));	
		}
	}

	public function determinerMoyenneCompetenceEtudiant($id) //determine le tab des moyennes de l'étudiant paser en parametre
	{
		$tab        = $this->getEnsCursus();
		$tabMoyenne = array();
		for($i = 0; $i<count($tab); $i++) // Parcours de la table Cursus
			if($tab[$i]->getCodeNIP() == $id)
			{
				$somme      = 0;
				$competence = $this->selectById($tab[$i]->getIdCompetence(), $this->getEnsCompetence());
				$tabMatiere = $competence->getTabMatieres();

				for($j = 0; $j<count($tabMatiere); $j++) $somme += $this->selectMoyenneParEtudiant($tabMatiere[$j]->getId(), $id);

				$tabMoyenne[$competence->getId()] = $somme / count($tabMatiere);
			}

		return $tabMoyenne;
	}

	public function determinerTabCompetence($idEtudiant) //retourne un double tableau associatif <String(nom de l'annee) , TableauAsso<String(nom de compétence), ADM ?)>>
	{
		$tabResultat = array(); 
		$tabSemestre = $this->determinerSemestre($idEtudiant);
		$anneeBUT    = 1;
		
		foreach($tabSemestre as $semestre) 
		{
			$tabCompetence = $this->determinerCompetence($semestre, $idEtudiant);
			foreach($tabCompetence as $key=>$competence) 
			{
				$tabTemp[$key] = $competence;


			}
			if($semestre % 2 == 0) 
			{
				$tabResultat['BUT'.$anneeBUT] = $tabTemp;
				$tabTemp                      = array();
				$anneeBUT++;
			}
		}
		return $tabResultat;
	}


	function printDoubleAssocArray($array, $indent = 0)
	{
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				echo str_repeat("\t", $indent) . "$key:\n";
				$this->printDoubleAssocArray($value, $indent + 1);
			} else {
				echo str_repeat("\t", $indent) . "$key: $value\n";
			}
		}
	}

	public function determinerSemestre($idEtudiant) {
		$tabSemestre = array(); 
		$tabCursus   = $this->getEnsCursus();
		
		foreach($tabCursus as $cursus) {
			if($cursus->getCodeNIP() == $idEtudiant) {
				$tabSemestre[$cursus->getNumSemestre()] = $cursus->getNumSemestre();
			}
		}
		
		return $tabSemestre;
	}
	
	public function determinerCompetence($numSemestre, $idEtudiant) {
		$tabCompetence = array();
		$tabCursus = $this->getEnsCursus();
		
		foreach($tabCursus as $cursus) {
			if($cursus->getNumSemestre() == $numSemestre && $cursus->getCodeNIP() == $idEtudiant) {
				$tabCompetence[$cursus->getIdCompetence()] = $this->selectCompetence($cursus->getIdCompetence(), $idEtudiant, $numSemestre);
			}
		}
		
		return $tabCompetence;
	}
	
	/***************************/
	/*  Méthode de recherche   */
	/***************************/

	public function getTabMatiere($id, $annee) : array //couple de clé primaire pour unec compétence
	{
		$taille     = count($this->getEnsCompetenceMatiere());
		$tab        =       $this->getEnsCompetenceMatiere();
		$tabMatiere = array();
		
		for($i = 0;$i<$taille;$i++)
		{
			if($tab[$i]->getIdCompetence() == $id && $tab[$i]->getAnnee() == $annee)
			{
				$tabMatiere[] = $this->selectById($tab[$i]->getIdMatiere(), $this->getEnsMatiere());
			}
		}

		return $tabMatiere;
	}

	public function selectCompetence($Competence, $idEtudiant, $idSemestre)
	{
		$tab = $this->getEnsCursus();
		for( $i = 0; $i < count($tab); $i++)
		{
			if($tab[$i]->getIdCompetence() == $Competence && $tab[$i]->getCodeNIP() == $idEtudiant && $tab[$i]->getNumSemestre() == $idSemestre)
			{
				return $tab[$i];
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

		for($i = 0; $i<$taille;$i++) if($tab[$i]->getId() == $id) return $tab[$i];
	}


}
?>
