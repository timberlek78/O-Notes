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
	} 

	// Getters
	public function getEnsCompetence       () { return $this->ensCompetence;        }
	public function getEnsCompetenceMatiere() { return $this->ensCompetenceMatiere; }
	public function getEnsCursus           () { return $this->ensCursus;            }
	public function getEnsEtude            () { return $this->ensEtude;             }
	public function getEnsEtudiant         () { return $this->ensEtudiant;          }
	public function getEnsEtudiantSemestre () { return $this->ensEtudiantSemestre;  }
	public function getEnsFPE              () { return $this->ensFPE;               }
	public function getEnsIllustration     () { return $this->ensIllustration;      }
	public function getEnsMatiere          () { return $this->ensMatiere;           }
	public function getEnsPossede          () { return $this->ensPossede;           }
	public function getEnsSemestre         () { return $this->ensSemestre;          }
	public function getEnsUtilisateur      () { return $this->ensUtilisateur;       }



	/***************************/
	/*  Méthode de recherche   */
	/***************************/

	public function setTabMatiere($id) : array
	{
		$taille     = count($this->getEnsCompetenceMatiere());
		$tab        = $this->getEnsCompetenceMatiere();
		$tabMatiere = array();
		
		for($i = 0;$i<$taille;$i++)
			if($tab[$i]->getNumMatiere() == $id) $tabMatiere[] = $tab[$i];
		
		return $tabMatiere;
	}

	public function selectAdmis($Competence, $Etudiant, $Semestre) : string
	{
		$tab = $this->getEnsCursus();
		for( $i = 0; $i < count($tab); $i++)
		{
			if($tab[$i]->getNumCompt() == $Competence->getId() && $tab[$i]->getIdEtudiant() == $Etudiant->getId() && $tab[$i]->getNumSemestre() == $Semestre->getId())
			{
				return $tab[$i]->getAdmission();
			}
		}

		return "";
	}

	public function selectSemestreById(int $id)
	{
		$taille = count( $this->getEnsSemestre() );
		$tab    = $this->getEnsSemestre();
		for($i = 0; $i<$taille;$i++)
		{
			if($tab[$i]->getId() == $id) return $tab[$i];
		}
	}

}
?>
