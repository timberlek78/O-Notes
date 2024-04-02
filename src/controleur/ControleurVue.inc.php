<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require "ControleurDB.inc.php";

	class ControleurVue
	{
		private $DB;

		public function __construct ( )
		{
			$this->DB = DB::getInstance ( );
			$retour = $this->DB->selectAll ( "Etudiant" );

			$tabDonnees = array();
			
			foreach ( $retour as $etudiant )
			{
				$etudiantDetails = array
				(
					'NIP'          => $etudiant->getNIP            ( ),
					'nom'          => $etudiant->getNom            ( ),
					'prenom'       => $etudiant->getPrenom         ( ),
					'parcours'     => $etudiant->getParcours       ( ),
					'promotion'    => $etudiant->getPromotion      ( ),
					'illustration' => $etudiant->getidillustration ( )
				);

				$tabDonnees [ ] = $etudiantDetails;
			}

			$json = json_encode( $tabDonnees );

			echo "JASON : " . $json;
		}
	}

	new ControleurVue();
?>