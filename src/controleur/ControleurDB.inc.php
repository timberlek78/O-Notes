<?php


	/******************************************/
	/*       Importation des objets PHP       */
	/******************************************/

	include (   "ConfigurationDB.inc.php"         );
	include ("../donnee/Competence.inc.php"       );
	include ("../donnee/CompetenceMatiere.inc.php");
	include ("../donnee/Cursus.inc.php"           );
	include ("../donnee/Etude.inc.php"            );
	include ("../donnee/Etudiant.inc.php"         );
	include ("../donnee/EtudiantSemestre.inc.php" );
	include ("../donnee/FPE.inc.php"              );
	include ("../donnee/Illustration.inc.php"     );
	include ("../donnee/Matiere.inc.php"          );
	include ("../donnee/Possede.inc.php"          );
	include ("../donnee/Semestre.inc.php"         );
	include ("../donnee/Utilisateur.inc.php"      );
	


	class DB
	{
		private static $instance = null; // instance DB pour le singleton
		private        $connect  = null;
		private static $schema   = 'onote';

		/******************************************/
		/*           Connexion à la DB            */
		/* utilisable seulement dans cette classe */
		/******************************************/

		private function __construct()
		{
			$configDB = new ConfigurationDB();

			//Connexion à la base de données
			$connStr = $this->preparerChaineConnexion( $configDB );

			try
			{
				//Connexion à la base
				$this->connect = new PDO( $connStr, $configDB->user, $configDB->pass );

				/***************************************************************************************/
				/* cmd tunnel ssh : ssh -L 5432:woody:5432 -p 4660 bt220243@corton.iut.univ-lehavre.fr */
				/***************************************************************************************/

				//Configutation facultative à la connexion
				$this->connect->setAttribute(PDO::ATTR_CASE   , PDO::CASE_LOWER       );
				$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				echo DB::$schema;
				// Requête pour définir le search_path
				$stmt = $this->connect->prepare('SET search_path TO '.DB::$schema);
				$stmt->execute();
			
				echo 'search_path défini avec succès sur : '.DB::$schema;
				echo "<br>";
			}
			catch(PDOException $e)
			{
					echo $configDB->host;
					echo "problème de connexion : ".$e->getMessage();
					return null;
			}
		}

		private function preparerChaineConnexion( $configurationDB )
		{
			$connexion = 'pgsql:host=' . $configurationDB->host . ' '.
						 'port='       . $configurationDB->port . ' '.
						 'dbname='     . $configurationDB->user;
			return $connexion;
		}

		/**********************************/
		/* Méthode pour avoir un objet DB */
		/*       L'objet est unique       */
		/**********************************/

		public static function getInstance()
		{
			if(is_null(self::$instance))
			{
				try 
				{
					self::$instance = new DB();
				}
				catch (PDOException $e) 
				{
					echo $e;
				}
			}//fin if

			$obj = self::$instance;

			if(($obj->connect) == null) self::$instance = null;

			return self::$instance;
		}

		public  function close    () { $this->connect = null; }


		private function execQuery($requete, $tparam, $nomClasse)
		{
			// Préparation de la requête
			$prepareStatement = $this->connect->prepare($requete);

			// Execution de la requête avec les paramètres fournis
			$prepareStatement->execute($tparam);

			echo $nomClasse;
			echo '--';
			// Récupération des résultats sous forme d'objet de la classe $nomClasse
			$prepareStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $nomClasse);
			
			// Récupération de tous les résultats dans un tableau
			$tab = $prepareStatement->fetchAll();

			return $tab;
		}

		private function execMaj($ordreSQl,$tparam = null)
		{
			$prepareStatement = $this->connect->prepare($ordreSQl);
			$res  = $prepareStatement->         execute($tparam  );

			return $prepareStatement->rowCount();
		}

		/***********************************/	
		/* Fonction utilisable dans le PHP */
		/***********************************/

		// Méthode select
		public function selectAll($nomClasse)
		{
			$requete = 'SELECT * FROM '.DB::$schema.'.'.$nomClasse;
			return $this->execQuery($requete,null,$nomClasse);
		}

		// Méthode delete
		public function delete($nomClasse, $objet)
		{
			$requete = 'DELETE FROM '.DB::$schema.'.'.$nomClasse.' WHERE '.$this->getColumnsNames($nomClasse)[0].' = ?';
			$tparam  = array(array_values($objet->getAttributs())[0]);

			$valeursAttributs = array_values($objet->getAttributs());
			$requeteAvecValeurs = preg_replace_callback('/\?/', function($matches) use (&$valeursAttributs) {
				// Vérifier si la valeur est un booléen et la remplacer par TRUE ou FALSE
				$valeur = array_shift($valeursAttributs);
				if (is_bool($valeur)) {
					return $valeur ? 'TRUE' : 'FALSE';
				} else {
					return "'" . $valeur . "'";
				}
			}, $requete);

			echo $requeteAvecValeurs;

			return $this->execMaj($requete,$tparam);
		}

		// Méthode d'insert
		public function insert($nomClasse, $objet)
		{
			// Construire la requête d'insertion
			$requete = $this->constructionInsert($nomClasse, $objet);

			// Remplacer les marqueurs de position par les valeurs des attributs
			$valeursAttributs = array_values($objet->getAttributs());
			$requeteAvecValeurs = preg_replace_callback('/\?/', function($matches) use (&$valeursAttributs) {
				// Vérifier si la valeur est un booléen et la remplacer par TRUE ou FALSE
				$valeur = array_shift($valeursAttributs);
				if (is_bool($valeur)) {
					return $valeur ? 'TRUE' : 'FALSE';
				} else {
					return "'" . $valeur . "'";
				}
			}, $requete);

			// Exécuter la requête d'insertion avec les valeurs des attributs
			$this->execMaj($requeteAvecValeurs);


		}

		//Méthode d'update
		public function update($nomTable, $objet)
		{
			$requete = $this->constructionRequeteUpdate($nomTable, $objet);
			$tparam = array();

			return $this->execMaj($requete,$tparam);
		}

		public function constructionRequeteUpdate($nomClasse, $objet)
		{
			$requete    = 'UPDATE ' . $this->schema.'.'.$nomClasse . ' SET ';
			$parametres = '';

			$tabAttribut = get_object_vars($objet);
			// Construction de la partie SET de la requête
			for ($i = 0; $i < count($tabAttribut); $i++) 
			{
				$parametres .= $this->getColumnsNames($nomClasse)[$i] . ' = ?';
				if ($i < count($tabAttribut) - 1) $parametres .= ', ';
			}

			$condition .= $this->getColumnsNames($nomClasse)[0] . ' = '.$objet->getId();
		
			// Construction de la requête complète
			$requete .= $parametres . $condition;

			return $requete; // Retourne la requête construite pour vérification ou exécution ultérieure
		}

		public function constructionInsert($nomClasse,$objet)
		{
			$requete    = 'INSERT INTO '.DB::$schema.'.'.$nomClasse.' (';

			$nbAttribut = count(array_keys($objet->getAttributs()));
			$colonnes   = "";
			//Précision des colonnes à remplir dans la BADO
			for ($i = 0; $i < $nbAttribut; $i++) $colonnes   .= ($i > 0 ? ',' : '').array_keys($objet->getAttributs())[$i];
			
			$colonnes .=")";
			$requete .= $colonnes." VALUES ";
			$parametres = "(";
			
			//Mise en place du nombre de paramètres nécessaire
			for ($i = 0; $i < $nbAttribut; $i++) $parametres .= ($i > 0 ? ',' : '').'?';
			
			$parametres .= ")";
			$requete    .= $parametres; //requête complète

			return $requete; //Retourne la requête prête à être envoyée

		}

		function getColumnsNames($table_name) {
			try {
				$name = strtolower($table_name);

				// Requête pour obtenir les noms de colonnes de la table spécifiée
				$stmt = $this->connect->prepare("SELECT column_name FROM information_schema.columns WHERE table_schema = ? AND table_name = ?");
				$stmt->execute([DB::$schema, $name]);
				
				// Récupération des résultats
				$columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
				
				// Retourner les noms de colonnes
				return $columns;
			} catch(PDOException $e) {	
				// Gérer les erreurs de connexion
				echo "Erreur : " . $e->getMessage();
				return array(); // Retourner un tableau vide en cas d'erreur
			}
		}
	}
?>