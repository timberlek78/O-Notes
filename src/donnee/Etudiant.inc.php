<?php
class Etudiant
{
	private int $idetudiant;
	private ?int $codenip;
	private ?string $nom;
	private ?string $prenom;
	private ?string $parcours;
	private ?string $promotion;
	private int $idillustration;
	private $tabMoyenne;

	private $Ue;
	private $moyenneG;

	public function __construct(?int $id = -1, int $codenip = -1, string $nom = "", string $prenom = "", string $parcours = "", string $promotion = "", int $idillustration = -1)
	{
		$this->idetudiant     = $id;
		$this->codenip        = $codenip;
		$this->nom            = $nom;
		$this->prenom         = $prenom;
		$this->parcours       = $parcours;
		$this->promotion      = $promotion;
		$this->idillustration = $idillustration;
	}

	public function getId            (): int    { return $this->idetudiant;      }
	public function getNIP           (): int    { return $this->codenip;         }
	public function getNom           (): string { return $this->nom;             }
	public function getPrenom        (): string { return $this->prenom;          }
	public function getParcours      (): string { return $this->parcours;        }
	public function getPromotion     (): string { return $this->promotion;       }
	public function getIdIllustration(): int    { return $this->idillustration;  }
	public function getTabMoyenne    (): array  { return $this->tabMoyenne;      }
	public function getUe            (): string { return $this->Ue;              }
	public function getMoyenneG      (): int    { return $this->moyenneG;        }
	public function getAttributs     (): array  { return get_object_vars($this); }

	public function setId            (int    $id            ) { $this->id             = $id;             }
	public function setcodenip       (int    $codenip       ) { $this->codenip        = $codenip;        }
	public function setNom           (string $nom           ) { $this->nom            = $nom;            }
	public function setPrenom        (string $prenom        ) { $this->prenom         = $prenom;         }
	public function setParcours      (string $parcours      ) { $this->parcours       = $parcours;       }
	public function setPromotion     (string $promotion     ) { $this->promotion      = $promotion;      }
	public function setIdIllustration(int    $idillustration) { $this->idillustration = $idillustration; }
	public function setUe            (string $ue            ) { $this->Ue             = $ue;             }
	public function setMoyenneG      (int    $moyenne       ) { $this->moyenneG       = $moyenne;        }
	public function setTabMoyenne    (array  $tab           ) { $this->tabMoyenne     = $tab;            }


	public function calculeMoyenneG()
	{
		$somme = 0;
		foreach(array_values($this->tabMoyenne) as  $moyenne ) $somme += $moyenne;

		$this->setMoyenneG($somme / count(array_keys($this->tabMoyenne)));
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