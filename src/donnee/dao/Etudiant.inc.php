<?php

require_once "ObjetDAO.inc.php";

class Etudiant extends ObjetDAO
{
	//clé primaire
	private string  $codenip;

	//attributs
	private ?string $nom;
	private ?string $prenom;
	private ?string $parcours;
	private ?string $promotion;

	//clé étrangère
	private ?string $specialite;
	private ?string $typebac;

	//attributs supplémentaires hors DAO
	private $cursus;

	private $tabMoyenne;

	private $tabBUT;
	private $Ue;
	private $moyenneG;

	public function __construct ( string $codenip="", string $nom="", string $prenom="", string $parcours="", string $promotion="", string $specialite="", string $typebac="" )
	{
		$this->codenip    = $codenip;
		$this->nom        = $nom;
		$this->prenom     = $prenom;
		$this->parcours   = $parcours;
		$this->promotion  = $promotion;
		$this->specialite = $specialite;
		$this->typebac    = $typebac;
	}

	public function getEqClesPrimaires ( ) : array
	{
		return array ( "codenip" => $this->codenip );
	}

	public function getEqAttributs ( ) : array
	{
		return array ( "codenip"    => $this->codenip,
					   "nom"        => $this->nom,
					   "prenom"     => $this->prenom,
					   "parcours"   => $this->parcours,
					   "promotion"  => $this->promotion,
					   "specialite" => $this->specialite,
					   "typebac"    => $this->typebac );
	}

	public function getCodeNIP ( ) : string
	{
		return $this->codenip;
	}

	public function setCodeNIP ( string $codeNIP )
	{
		$this->codenip = $codeNIP;
	}

	public function getNom ( ) : string
	{
		return $this->nom;
	}

	public function setNom ( string $nom )
	{
		$this->nom = $nom;
	}

	public function getPrenom ( ) : string
	{
		return $this->prenom;
	}

	public function setPrenom ( string $prenom )
	{
		$this->prenom = $prenom;
	}

	public function getParcours ( ) : string
	{
		return $this->parcours;
	}

	public function setParcours ( string $parcours )
	{
		$this->parcours = $parcours;
	}

	public function getPromotion ( ) : string
	{
		return $this->promotion;
	}

	public function setPromotion ( string $promotion )
	{
		$this->promotion = $promotion;
	}

	public function getSpecialite ( ) : string
	{
		return $this->specialite;
	}

	public function setSpecialite ( string $specialite )
	{
		$this->specialite = $specialite;
	}

	public function getTypeBac ( ) : string
	{
		return $this->typebac;
	}

	public function setTypeBac ( string $typebac )
	{
		$this->typebac = $typebac;
	}


	//TODO: créer plutot un objet à part qui étend de ETUDIANT
	/*----------------------------------------*/
	/*------------METHODES HORS DAO-----------*/
	/*----------------------------------------*/

	public function getMoyenneG ( )
	{
		return $this->moyenneG;
	}

	public function setMoyenneG ( $moy )
	{
		$this->moyenneG = $moy;
	}

	public function calculeMoyenneG ( )
	{
		if ( !empty ( $this->tabMoyenne ) )
		{
			$somme = 0;
			foreach ( array_values ( $this->tabMoyenne ) as $moyenne )
			{
				$somme += $moyenne;
			}
	
			$this->setMoyenneG ( $somme / count(array_keys($this->tabMoyenne ) ) );
		}
		else
		{
			$this->setMoyenneG ( 0 );
		}
	}

	public function getTabCursus ( )
	{
		return $this->cursus;
	}

	public function setTabCursus ( $tab )
	{
		$this->cursus = $tab;
	}

	public function getTabMoyenne ( )
	{
		return $this->tabMoyenne;
	}

	public function setTabMoyenne ( $tab )
	{
		$this->tabMoyenne = $tab;
	}

	public function getUe ( )
	{
		return $this->Ue;
	}

	public function setUe ( $ue )
	{
		$this->Ue = $ue;
	}

	public function determinerUe ( )
	{
		$nbUe = 0;
		foreach ( array_values ( $this->tabMoyenne ) as $moyenne )
		{
			if($nbUe >= 6) break;
			if ( $moyenne > 10 ) $nbUe += 1;

			
		}
		$this->setUe ( "".$nbUe."/".count ( array_keys ( $this->tabMoyenne ) ) );
	}

	public function getTabBut ( ) : array
	{
		return $this->tabBUT;
	}

	public function setTabBut ( array $tabBUT )
	{
		$this->tabBUT = $tabBUT;
	}

	public function getAttributExcel ( ) : array
	{
		$tab = array ( );
		$tab['Code NIP'] = $this->codenip;
		$tab['Nom']      = $this->nom;
		$tab['Prenom']   = $this->prenom;
		$tab['Parcours'] = $this->parcours;

		echo "Dans Etudiant";
		var_dump ( $this->cursus );

		$tab['Cursus'] = $this->cursus;

		return $tab;
	}

	public function definirTableCursus ( )
	{
		$tabCursus = array ( );
		$tabAnnee  = array ( );

		$tabBUT = $this->getTabBUT ( );

		foreach ( $tabBUT as $but )
		{
			$semestreImpair = $but->getSemestreImpair ( );
			$semestrePair   = $but->getSemestrePair   ( );

			if ( !empty ( $semestreImpair ) && !in_array ( $but->getAnnee ( ), $tabAnnee ) )
			{
				$tabCursus[] = "S" . $but->getNumSemestreImpair ( );
				$tabAnnee[]  = $but->getAnnee ( );
			}

			if ( !empty ( $semestrePair ) && !in_array ( $but->getAnnee ( ), $tabAnnee ) )
			{
				$tabCursus[] = "S" . $but->getNumSemestrePair ( );
				$tabAnnee[]  = $but->getAnnee ( );
			}
		}
		return $tabCursus;
	}
}
?>