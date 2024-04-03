<?php
class Etudiant
{
	//clé primaire
	private int     $codenip;

	//attributs
	private ?string $nom;
	private ?string $prenom;
	private ?string $parcours;
	private ?string $promotion;
	private int $idillustration;
	private int $idEtude;

	private $tabMoyenne;

	private $tabBUT;
	private $Ue;
	private $moyenneG;

	public function __construct( int $codenip=-1, string $nom="", string $prenom="", string $parcours="", string $promotion="", int $idillustration=-1, int $idEtude =-1 )
	{
		$this->codenip        = $codenip;
		$this->nom            = $nom;
		$this->prenom         = $prenom;
		$this->parcours       = $parcours;
		$this->promotion      = $promotion;
		$this->idillustration = $idillustration;
		$this->idEtude        = $idEtude;
	}

	public function getId(): int
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

	public function getidillustration(): int
	{
		return $this->idillustration;
	}

	public function getTabBUT() : array
	{
		return $this->tabBUT;
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
		$tab['Cursus']   = $this->cursus;

		return $tab;
	}

	public function setTabBUT(array $tabBUT)
	{
		$this->tabBUT = $tabBUT;
	}

	public function setcodeNIP( int $codeNIP ): void
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

	public function setidillustration( int $idillustration ): void
	{
		$this->idillustration = $idillustration;
	}

	public function getIdEtude()
	{
		return $this->idEtude;
	}

	public function setIdEtude($idEtude)
	{
		$this->idEtude = $idEtude;

	}

	public function getUe            (): string { return $this->Ue;              }
	public function getMoyenneG      (): int    { return $this->moyenneG;        }
	public function getTabMoyenne    (): array  { return $this->tabMoyenne;      }

	public function setUe            (string $ue            ) { $this->Ue             = $ue;             }
	public function setMoyenneG      (int    $moyenne       ) { $this->moyenneG       = $moyenne;        }
	public function setTabMoyenne    (array  $tab           ) { $this->tabMoyenne     = $tab;   }

	public function calculeMoyenneG()
	{
		if(!empty($this->tabMoyenne))
		{
			$somme = 0;
			foreach(array_values($this->tabMoyenne) as  $moyenne ) $somme += $moyenne;
	
			$this->setMoyenneG($somme / count(array_keys($this->tabMoyenne)));
		}
		else
		{
			$this->setMoyenneG(0);
		}
	
	}

	public function determinerUe()
	{
		$nbUe = 0;
		foreach(array_values($this->tabMoyenne) as $moyenne )
		{
			if($moyenne > 10) $nbUe += 1;
		}
		$this->setUe( "".$nbUe."/".count(array_keys($this->tabMoyenne)));

	}
}

?>