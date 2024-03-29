<?php

	include ("ConfigurationDB.inc.php");
	include ("../donnee/Competence.inc.php");
	include ("../donnee/Etudiant.inc.php"  );
	include ("../donnee/CompetenceMatiere.inc.php");
	include ("../donnee/Cursus.inc.php");
	include ("../donnee/Etude.inc.php");
	


	class DB
	{
		private static $instance = null; // instance DB pour le singleton
		private $connect         = null;
		private static $schema   = 'onote.';

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

				//Configutation facultative à la connexion
				$this->connect->setAttribute(PDO::ATTR_CASE   , PDO::CASE_LOWER       );
				$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
			$connexion = 'pgsql:host=' . $configDB->host . ' '.
						 'port='       . $configDB->port . ' '.
						 'dbname='     . $configDB->user;
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

		/*
		private function execQuery($requete, $tparam,$nomClasse)
		{
			//préparation de la requête
			$prepareStatement = $this->connect->prepare($requete);

			//récupération des tuples sous forme d'objet de la classe $nomClasse
			$prepareStatement->setAttribute(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $nomClasse);

			//Execution de la requête 
			if($tparam != null)
			{
				$prepareStatement->execute($tparam);
			}

			//Récupération du résultat sous forme d'un tableau d'objet
			$tab   =        array();
			$tuple = $prepareStatement->fetch();

			if($tuple)
			{
				//Un tuple a été envoyé
				while($tuple != false)
				{
					$tab[] = $tuple;         //on ajoute les objets à la fin du tableau
					$tuple = $prepareStatement->fetch(); //on recupère un autre objet.
				}//fin du while
			}
			return $tab;
		}
		*/

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

		private function execMaj($ordreSQl,$tparam)
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
			$requete = 'SELECT * FROM '.DB::$schema.$nomClasse;
			return $this->execQuery($requete,null,$nomClasse);
		}

		// Méthode delete
		public function delete($nomClasse, $id, $libId)
		{
			$requete = 'DELETE FROM '.DB::$schema.$nomClasse .' WHERE '. $libId.' = ?';
			$tparam  = array($id);
			return $this->execMaj($requete,$tparam);
		}

		// Méthode d'insert
		public function insert($nomClasse, $tabAttribut)
		{
			$requete = 'INSERT INTO '.$this->schema.$nomClasse.' VALUES ';

			$parametres = "(";
			
			for ($i = 0; $i < count($tabAttribut); $i++) $parametres .= ($i != 0 ? ',' : '') . '?';

			echo $parametres;

			$requete .= $parametres;

			$tparam = $tabAttribut;

			return $this->execMaj($requete,$tparam);
		}

		//Méthode d'update
		public function update($nomTable, $tabAttribut, $tabValeurAttribut, $tabCondition, $tabValeurCondition)
		{
			$requete = $this->constructionRequeteUpdate($nomTable, $tabAttribut, $tabValeurAttribut, $tabCondition);

			$tparam = array($tabValeurAttribut,$tabValeurCondition);

			return $this->execMaj($requete,$tparam);
		}

		public function constructionRequeteUpdate($nomClasse, $tabAttribut, $tabValeurAttribut, $tabCondition)
		{
			$requete    = 'UPDATE ' . $this->schema.$nomClasse . ' SET ';
			$parametres = '';

			// Construction de la partie SET de la requête
			for ($i = 0; $i < count($tabAttribut); $i++) 
			{
				$parametres .= $tabAttribut[$i] . ' = ?';
				if ($i < count($tabAttribut) - 1) $parametres .= ', ';
			}

			// Construction de la partie WHERE de la requête
			$condition = ' WHERE ';
			for ($i = 0; $i < count($tabCondition); $i++)
			{
				$condition .= $tabCondition[$i] . ' = ?';
				if ($i < count($tabCondition) - 1) $condition .= ' AND ';
			}

			// Construction de la requête complète
			$requete .= $parametres . $condition;

			// Maintenant, exécutez votre requête SQL ici...
			// Assurez-vous d'avoir une connexion à votre base de données et d'exécuter la requête avec les valeurs appropriées.

			return $requete; // Retourne la requête construite pour vérification ou exécution ultérieure
		}

	}
?>