<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	
	include '../controleur/ControleurDB.inc.php';
	include '../donnee/Competence.inc.php';
	include '../donnee/CompetenceMatiere.inc.php';
	include '../donnee/Cursus.inc.php';
	include '/home/etudiant/bt220243/public_html/bebou/O-Notes/src/donnee/BUT.inc.php';



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
			$etudiant->setTabMoyenne($this->determinerMoyenneCompetenceEtudiant($etudiant->getCodeNIP()));
			$etudiant->setTabBUT    ($this->determinerTabCompetence            ($etudiant->getCodeNIP()));
			$etudiant->setTabCursus( $etudiant->definirTableCursus() );
			$etudiant->calculeMoyenneG();
			$etudiant->determinerUe   ();
		}
	}

	private function attribuerMatiereCompetence($tab)
	{
		foreach($tab as $competence)
		{
			$competence->setTabMatieres($this->getTabMatiere($competence->getIdCompetence(), $competence->getAnnee()));	
		}
	}

	public function determinerMoyenneCompetenceEtudiant($id) //determine le tab des moyennes de l'étudiant paser en parametre
	{
		$tab        = $this->getEnsCursus();
		$tabMoyenne = array();
		foreach($tab as $cursus) // Parcours de la table Cursus
			if($cursus->getCodeNIP() == $id)
			{
				$somme      = 0;
				$competence = $this->selectByIdEtAnnee( $cursus->getIdCompetence(), $cursus->getAnnee(), $this->getEnsCompetence() );
				$tabMatiere = $competence->getTabMatieres();

				for($j = 0; $j<count($tabMatiere); $j++) $somme += $this->selectMoyenneParEtudiant($tabMatiere[$j]->getIdMatiere(), $id);

				$tabMoyenne[$competence->getIdCompetence()] =round($somme / count($tabMatiere),2);
			}
		return $tabMoyenne;
	}

	public function determinerTabCompetence($idEtudiant)
{
    $tabBUT      = array(); 
    $tabSemestre = $this->determinerSemestre($idEtudiant); // Semestres auxquels l'étudiant a participé
    $anneeBUT    = 1;

    $nvBUT = new BUT($anneeBUT); // Création du premier objet BUT

    foreach($tabSemestre as $semestre)
    {
        $tabTemp = array(); // Réinitialiser le tableau temporaire à chaque itération

        $tabCompetence = $this->determinerCompetence($semestre, $idEtudiant); // Déterminer les compétences du semestre 

        foreach($tabCompetence as $competence)
        {
            $tabTemp[$competence->getIdCompetence()] = $competence;
        }

        if($semestre % 2 == 0)
        {
			$nvBUT->setNumSemestrePair($semestre);
            $nvBUT->setSemestrePair   ($tabTemp );
        }
        else
        {
			$nvBUT->setNumSemestreImpair($semestre);
            $nvBUT->setSemestreImpair   ($tabTemp );
        }

        // Si le semestre est pair ou si c'est le dernier semestre, ajoutez l'objet BUT au tableau
        if($semestre % 2 == 0 || $semestre == end($tabSemestre))
        {
            $tabBUT[] = $nvBUT; // Ajout de l'objet BUT au tableau
            $anneeBUT++;
            $nvBUT = new BUT($anneeBUT); // Création d'un nouvel objet BUT pour la prochaine année BUT
        }
    }

    return $tabBUT;
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

		echo "<br> annee";
		var_dump($annee);
		echo "<br> id";
		var_dump($id);
		
		foreach($tab as $competenceMatiere)
		{
			echo "<br>\$competenceMatiere->getIdCompetence()";
			var_dump($competenceMatiere->getIdCompetence());
			echo "<br>\$competenceMatiere->getAnnee()";
			var_dump($competenceMatiere->getAnnee());

			if($competenceMatiere->getIdCompetence() == $id && $competenceMatiere->getAnnee() == $annee)
			{
				var_dump($this->selectById($competenceMatiere->getIdMatiere(), $this->getEnsMatiere()));
				$tabMatiere[] = $this->selectById($competenceMatiere->getIdMatiere(), $this->getEnsMatiere());
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
		foreach($tab as $objet)
		{
			if(array_values( $objet->getEqClesPrimaires())[0] == $id) return $objet;
		}
	}

	public function selectByIdEtAnnee( $id, $annee, $tab )
	{
		$taille = count( $tab );

		for ( $i = 0; $i < $taille; $i++ ) if ( $tab[$i]->getIdCompetence() == $id && $tab[$i]->getAnnee() ) return $tab[$i];
	}
}
?>
