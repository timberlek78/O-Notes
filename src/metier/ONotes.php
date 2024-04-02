<?php
	
	include '../controleur/ControleurDB.inc.php';
	include '../donnee/Competence.inc.php';
	include '../donnee/CompetenceMatiere.inc.php';
	include '../donnee/Cursus.inc.php';



class ONote
{
	private $ensCompetence, $ensCompetenceMatiere, $ensCursus, $ensEtude, $ensEtudiant, $ensEtudiantSemestre, $ensFPE, $ensIllustration, $ensMatiere, $ensPossede, $ensSemestre, $ensUtilisateur;

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

	private function attribuerMoyenneEtudiant($tab)
	{
		foreach ($tab as $index => $etudiant) 
		{
			$etudiant->setTabMoyenne($this->determinerMoyenneCompetenceEtudiant($etudiant->getNIP()));
			$etudiant->calculeMoyenneG();
			$etudiant->determinerUe   ();
		}
	}

	private function attribuerMatiereCompetence($tab)
	{
		foreach($tab as $competence)
		{
			$competence->setTabMatieres($this->getTabMatiere($competence->getIdCompetence()));
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
				$tabMatiere = $competence->getMatieres();
				
				for($j = 0; $j<count($tabMatiere); $j++) $somme += $tabMatiere[$j]->getmoyenne();

				$tabMoyenne[$competence->getIdCompetence()] = $somme / count($tabMatiere);
			}
		return $tabMoyenne;
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
			echo "\$tab[\$i]->getIdMatiere()" . $tab[$i]->getIdCompetence();
			echo "<br>\$id".$id;
			echo "<br>";
			if($tab[$i]->getIdCompetence() == $id)
			{
				echo "jesuis la";
				$tabMatiere[] = $this->selectById($tab[$i]->getIdMatiere(), $this->getEnsMatiere());
			}
		}

		return $tabMatiere;
	}

	public function selectAdmis($Competence, $Etudiant, $Semestre) : string
	{
		$tab = $this->getEnsCursus();
		for( $i = 0; $i < count($tab); $i++)
		{
			if($tab[$i]->getIdCompetence() == $Competence->getIdCompetence() && $tab[$i]->getIdEtudiant() == $Etudiant->getId() && $tab[$i]->getNumSemestre() == $Semestre->getId())
			{
				return $tab[$i]->getAdmission();
			}
		}

		return "";
	}

	public function selectById($id, $tab)
	{
		$taille = count( $tab );
		for($i = 0; $i<$taille;$i++) if($tab[$i]->getId() == $id) return $tab[$i];
	}


}
?>
