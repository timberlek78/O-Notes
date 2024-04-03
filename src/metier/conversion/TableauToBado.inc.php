<?php
	require __DIR__.'/../../../lib/vendor/autoload.php';

	include ( __DIR__."/../../controleur/ControleurDB.inc.php" );
	require_once __DIR__.'/../../donnee/IncludeAll.php';


	class TableauToBado
	{
		private DonneesONote $donneesONote;
		private $DB;

		function __construct( DonneesONote $donneesONote )
		{
			$this->donneesONote = $donneesONote;
			$this->DB = DB::getInstance();
		}

		public function insererSiNouveau( $classeElement, $ensElement )
		{
			foreach ($ensElement as $element) {

				$ensElementBado = $this->DB->selectAll( $classeElement );

				$existe = false;

				foreach ($ensElementBado as $elementBado) {
					if ($element->equals($elementBado)) {
						$existe = true;
						break;
					}
				}

				if (!$existe) {
					$this->DB->insert( $classeElement, $element );
				}
			}
		}

		public function insertAll()
		{
			self::insererSiNouveau( "Etude", $this->donneesONote->ensEtude );
			self::insererSiNouveau( "Etudiant", $this->donneesONote->ensEtudiant );
			self::insererSiNouveau( "Competence", $this->donneesONote->ensCompetence );
			self::insererSiNouveau( "Semestre", $this->donneesONote->ensSemestre );
			self::insererSiNouveau( "Matiere", $this->donneesONote->ensMatiere );
			self::insererSiNouveau( "CompetenceMatiere", $this->donneesONote->ensCompetenceMatiere );
			self::insererSiNouveau( "Cursus", $this->donneesONote->ensCursus );
			self::insererSiNouveau( "EstNote", $this->donneesONote->ensEstNote );
			self::insererSiNouveau( "EtudiantSemestre", $this->donneesONote->ensEtudiantSemestre );
		}
		
	}
?>