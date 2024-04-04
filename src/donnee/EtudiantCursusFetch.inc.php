<?php
class EtudiantCursusFetch
{
	//clé primaire
	public $codenip;

	//attributs
	public $nom;
	public $prenom;
	public $parcours;
	public $promotion;

	//clé étrangère
	public $specialite;
	public $typebac;

	//attributs
	public $passage;
	public $rang;
	public $nbabs;

	public $tabCursus;


	public function __construct( string $codenip="", string $nom="", string $prenom="", string $parcours="", string $promotion="", string $specialite="", string $typebac="", string $passage="", int $rang=-1, int $nbabs=-1 )
	{
		$this->codenip        = $codenip;
		$this->nom            = $nom;
		$this->prenom         = $prenom;
		$this->parcours       = $parcours;
		$this->promotion      = $promotion;
		$this->specialite     = $specialite;
		$this->typebac        = $typebac;

		$this->passage = $passage;
		$this->rang    = $rang;
		$this->nbabs   = $nbabs;

		$this->tabCursusFetch = array();
	}

	public function addCursus($cursus)
	{
		$idcompetence = $cursus['idcompetence'];
		$admission = $cursus['admission'];
		$idmatiere = $cursus['idmatiere'];
		$coeff = $cursus['coeff'];

		// Vérifiez si nous avons déjà un CursusFetch pour cet idcompetence
		if (isset($this->tabCursus[$idcompetence]))
		{
			// Si c'est le cas, ajoutez simplement la matiere à son tableau de matieres
			$matiere = array('libelle' => $idmatiere, 'coeff' => $coeff);
			$this->tabCursus[$idcompetence]->addMatiere($matiere);
		}
		else
		{
			// echo 'nouveau';
			// var_dump($resultat);
			// Sinon, créez un nouvel objet CursusFetch et ajoutez-le à $tabRet
			$cursusFetch = new CursusFetch($idcompetence, $admission);
			$matiere = array('libelle' => $idmatiere, 'coeff' => $coeff);
			$cursusFetch->addMatiere($matiere);
			$this->tabCursus[$idcompetence] = $cursusFetch;
		}
	}
}
?>