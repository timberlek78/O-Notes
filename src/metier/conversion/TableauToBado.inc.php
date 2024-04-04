<?php
	require __DIR__.'/../../../lib/vendor/autoload.php';

	require_once __DIR__.'/../../controleur/ControleurDB.inc.php';
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

		public function insererSiNouveau( $classeElement, array $ensElement )
		{
			foreach( $ensElement as $element )
			{
				//$this->DB->beginTransaction();

				try
				{
					//echo "Test insertion de " . $classeElement . " : " . $element . "<br>";
					$this->DB->insert( $classeElement, $element );
					//$this->DB->commit();
				}
				catch( Exception $e )
				{
					try
					{
						//echo "Test mise à jour de " . $classeElement . " : " . $element . "<br>";
						if( $classeElement == "Etudiant" or $classeElement == "Semestre" or $classeElement == "Competence" )
							$this->DB->update( $classeElement, $element );
					}
					catch( Exception $e )
					{
						echo "<span style='color:RED'>Remarque :</span> " . $e->getMessage() . "<br>";
					}
				}
			}
		}

		public function insertAll()
		{
			self::insererSiNouveau( "Etude", $this->donneesONote->ensEtude );
			echo "Etude insérée <br>";
			self::insererSiNouveau( "Etudiant", $this->donneesONote->ensEtudiant );
			echo "Etudiant inséré <br>";
			self::insererSiNouveau( "Competence", $this->donneesONote->ensCompetence );
			echo "Competence insérée <br>";
			self::insererSiNouveau( "Semestre", $this->donneesONote->ensSemestre );
			echo "Semestre inséré <br>";
			self::insererSiNouveau( "Matiere", $this->donneesONote->ensMatiere );
			echo "Matiere insérée <br>";
			self::insererSiNouveau( "CompetenceMatiere", $this->donneesONote->ensCompetenceMatiere );
			echo "CompetenceMatiere insérée <br>";
			self::insererSiNouveau( "Cursus", $this->donneesONote->ensCursus );
			echo "Cursus inséré <br>";
			self::insererSiNouveau( "EstNote", $this->donneesONote->ensEstNote );
			echo "EstNote inséré <br>";
			self::insererSiNouveau( "EtudiantSemestre", $this->donneesONote->ensEtudiantSemestre );
			echo "EtudiantSemestre inséré <br>";
		}
		
	}
?>