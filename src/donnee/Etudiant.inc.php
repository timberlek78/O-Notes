<?php
class Etudiant
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

	private $cursus;

	private $tabMoyenne;

	private $tabBUT;
	private $Ue;
	private $moyenneG;

	public function __construct( string $codenip="", string $nom="", string $prenom="", string $parcours="", string $promotion="", string $specialite="", string $typebac="" )
	{
		$this->codenip        = $codenip;
		$this->nom            = $nom;
		$this->prenom         = $prenom;
		$this->parcours       = $parcours;
		$this->promotion      = $promotion;
		$this->specialite     = $specialite;
		$this->typebac        = $typebac;
	}

	public function getEqClesPrimaires( ) : array
	{
		return array( "codenip" => $this->codenip );
	}

	public function getCodeNIP(): string
	{
		return $this->codenip;
	}

	public function getNom(): string
	{
		return $this->nom;
	}

	public function getPrenom(): string
	{
		return $this->prenom;
	}

	public function getParcours(): string
	{
		return $this->parcours;
	}

	public function getPromotion(): string
	{
		return $this->promotion;
	}

	public function getSpecialite(): string
	{
		return $this->specialite;
	}

	public function getTypeBac(): string
	{
		return $this->typebac;
	}

	public function getAttributs() : array
	{
		return get_object_vars($this);
	}

	public function getAttributExcel() : array
	{
		$tab = array();
		$tab['Code NIP'] = $this->codenip;
		$tab['Nom']      = $this->nom;
		$tab['Prenom']   = $this->prenom;
		$tab['Parcours'] = $this->parcours;


		echo"Dans Etudiant";
		var_dump($this->cursus);
		$tab['Cursus']   = $this->cursus;

		return $tab;
	}

	public function definirTableCursus()
{
    $tabCursus = array();
    $tabAnnee  = array();

    $tabBUT = $this->getTabBUT();

    foreach ($tabBUT as $but) {
        $semestreImpair = $but->getSemestreImpair();
        $semestrePair   = $but->getSemestrePair  ();

        if (!empty($semestreImpair) && !in_array( $but->getAnnee(), $tabAnnee)) {
            $tabCursus[] = "S" . $but->getNumSemestreImpair();
            $tabAnnee[] = $but->getAnnee();
        }

        if (!empty($semestrePair) && !in_array( $but->getAnnee(), $tabAnnee)) {
            $tabCursus[] = "S" . $but->getNumSemestrePair();
            $tabAnnee[] = $but->getAnnee();
        }
    }
    return $tabCursus;
}

	public function setTabBUT(array $tabBUT)
	{
		$this->tabBUT = $tabBUT;
	}

	public function setCodeNIP( string $codeNIP ): void
	{
		$this->codenip = $codeNIP;
	}

	public function setNom( string $nom ): void
	{
		$this->nom = $nom;
	}

	public function setPrenom( string $prenom ): void
	{
		$this->prenom = $prenom;
	}

	public function setParcours( string $parcours ): void
	{
		$this->parcours = $parcours;
	}

	public function setPromotion( string $promotion ): void
	{
		$this->promotion = $promotion;
	}

	public function __toString(): string
	{
		return "Etudiant : codenip=".$this->codenip.", nom=".$this->nom.", prenom=".$this->prenom.", parcours=".$this->parcours.", promotion=".$this->promotion;
	}

	public function equals( Etudiant $etudiant ): bool
	{
		return $this->codenip === $etudiant->codenip;
	}

	public function setIdEtude($idEtude)
	{
		$this->idEtude = $idEtude;
	}
}
?>