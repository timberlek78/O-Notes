<?php
/******************************************/
/*       Importation des objets PHP       */
/******************************************/

include ( "ConfigurationDB.inc.php" );
require_once __DIR__.'/../donnee/IncludeAll.php';

class DB
{
	private static $instance = null; // instance DB pour le singleton
	private        $connect  = null;
	private static $schema   = 'onote';

	/******************************************/
	/*           Connexion à la DB            */
	/* utilisable seulement dans cette classe */
	/******************************************/

	private function __construct ( )
	{
		$configDB = new ConfigurationDB ( );

		//Connexion à la base de données
		$connStr = $this->preparerChaineConnexion ( $configDB );

		try
		{
			//Connexion à la base
			$this->connect = new PDO ( $connStr, $configDB->user, $configDB->pass );

			//Configutation facultative à la connexion
			$this->connect->setAttribute ( PDO::ATTR_CASE   , PDO::CASE_LOWER        );
			$this->connect->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

			// Requête pour définir le search_path
			$stmt = $this->connect->prepare ( 'SET search_path TO '.DB::$schema );
			$stmt->execute ( );
		
			echo 'search_path défini avec succès sur : '.DB::$schema;
			echo "<br>";
		}
		catch ( PDOException $e )
		{
			echo $configDB->host;
			echo "problème de connexion : ".$e->getMessage ( );
		}
	}

	private function preparerChaineConnexion ( $configurationDB )
	{
		$connexion = 'pgsql:host=' . $configurationDB->host . ' '.
					 'port='       . $configurationDB->port . ' '.
					 'dbname='     . $configurationDB->user;
		return $connexion;
	}

	/***********************************/
	/* Factory Singleton de l'objet DB */
	/*       L'objet est unique        */
	/***********************************/

	public static function getInstance ( )
	{
		if ( is_null ( self::$instance ) )
		{
			try 
			{
				self::$instance = new DB ( );
			}
			catch ( PDOException $e )
			{
				echo $e;
			}
		}

		$obj = self::$instance;

		if ( ( $obj->connect ) == null ) self::$instance = null;

		return self::$instance;
	}

	public function close ( )
	{
		$this->connect = null;
	}

	/***********************************/
	/*    Exécution des requêtes SQL   */
	/***********************************/

	private function execQuery ( $requete, $tparam, $nomClasse )
	{
		// Préparation de la requête
		$prepareStatement = $this->connect->prepare ( $requete );

		// Execution de la requête avec les paramètres fournis
		$prepareStatement->execute ( $tparam );

		//echo $nomClasse . " - ";

		// Récupération des résultats sous forme d'objet de la classe $nomClasse
		$prepareStatement->setFetchMode ( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $nomClasse );
		
		// Récupération de tous les résultats dans un tableau
		$tab = $prepareStatement->fetchAll ( );

		return $tab;
	}

	private function execMaj ( $ordreSQl, $tparam = null )
	{
		$prepareStatement = $this->connect->prepare ( $ordreSQl );
		$res  = $prepareStatement->         execute ( $tparam   );

		return $prepareStatement->rowCount ( );
	}

	/***********************************/
	/*          Outils internes        */
	/***********************************/

	private function getRequeteAvecValeurs ( array $valeursAttributs, $requete )
	{
		return preg_replace_callback ( '/\?/', function ( $matches ) use ( &$valeursAttributs )
		{
			// Vérifier si la valeur est un booléen et la remplacer par TRUE ou FALSE
			$valeur = array_shift ( $valeursAttributs );
			if ( is_bool ( $valeur ) )
			{
				return $valeur ? 'TRUE' : 'FALSE';
			}
			else
			{
				return "'" . $valeur . "'";
			}
		}, $requete );
	}

	/***********************************/
	/*      Requetes particulieres     */
	/***********************************/

	function getColumnsNames ( $table_name )
	{
		$columns = array ( );

		try
		{
			$name = strtolower ( $table_name );

			// Requête pour obtenir les noms de colonnes de la table spécifiée
			$stmt = $this->connect->prepare ( "SELECT column_name FROM information_schema.columns WHERE table_schema = ? AND table_name = ?" );
			$stmt->execute ( [DB::$schema, $name] );
			
			// Récupération des résultats
			$columns = $stmt->fetchAll ( PDO::FETCH_COLUMN );
		}
		catch ( PDOException $e )
		{	
			echo "Erreur : " . $e->getMessage ( );
		}

		return $columns;
	}

	/***********************************/
	/*        Fonctions SELECT         */
	/***********************************/

	public function selectAll ( $nomTable )
	{
		$requete = 'SELECT * FROM '.DB::$schema.'.'.$nomTable;
		return $this->execQuery ( $requete, null, $nomTable );
	}

	public function selectAllWhere ( $nomTable, $condition, $valeur, $connecteur = null, $condition2 = null, $valeur2 = null )
	{
		$requete = 'SELECT * FROM '.DB::$schema.'.'.$nomTable . ' WHERE ' . $condition . ' = ?';

		$parametres = array ( $valeur );
		
		if ( $connecteur != null && $condition2 != null && $valeur2 != null )
		{
			$requete .= ' ' . $connecteur . ' ' . $condition2 . ' = ?';
			$parametres[] = $valeur2;
		}
		return $this->execQuery ( $requete, $parametres, $nomTable );
	}

	public function selectAllWherePrecis ( $distinct=false, $colonne="", $nomTable, $condition, $valeur )
	{
		$requete = 'SELECT ' . ( $distinct ? 'DISTINCT' : '' ) . ' ' . $colonne . ' FROM ' . DB::$schema. '.' . $nomTable . ' WHERE ' . $condition . ' = ?';

		$parametres = array ( $valeur );

		return $this->execQuery ( $requete, $parametres, $nomTable);
	}

	/***********************************/
	/*        Fonctions DELETE         */
	/***********************************/

	public function delete ( $nomTable, $objet ) //TODO: vérifier que la méthode fonctionne
	{
		$requete = 'DELETE FROM '.DB::$schema.'.'.$nomTable.' WHERE '.$this->getColumnsNames ( $nomTable )[0].' = ?';
		$tparam  = array ( array_values ( $objet->getEqAttributs ( ) )[0] );

		$valeursAttributs = array_values ( $objet->getEqAttributs ( ) );
		$requeteAvecValeurs = $this->getRequeteAvecValeurs ( $valeursAttributs, $requete );

		return $this->execMaj ( $requete,$tparam );
	}

	/***********************************/
	/*        Fonctions INSERT         */
	/***********************************/

	public function insert ( $nomTable, $objet )
	{
		// Construire la requête d'insertion
		$requete = $this->constructionInsert ( $nomTable, $objet );

		$tparam  = array ( );
		foreach( $objet->getEqAttributs ( ) as $cle => $valeur )
		{
			$tparam[] = $valeur;
		}

		// Remplacer les marqueurs de position par les valeurs des attributs
		$valeursAttributs   = $tparam;
		$requeteAvecValeurs = $this->getRequeteAvecValeurs ( $valeursAttributs, $requete );

		// Exécuter la requête d'insertion avec les valeurs des attributs
		$this->execMaj ( $requeteAvecValeurs );
	}

	private function constructionInsert ( $nomClasse, $objet )
	{
		$requete    = 'INSERT INTO '.DB::$schema.'.'.$nomClasse;

		$nbAttribut = count ( array_keys ( $objet->getEqAttributs ( ) ) );

		$colonnes   = " (";
		$parametres = " VALUES (";

		$cptCol = 0;
		foreach( $objet->getEqAttributs ( ) as $cle => $valeur )
		{
			$colonnes .= ( $cptCol > 0 ? ',' : '' ) . $cle;
			$parametres .= ( $cptCol > 0 ? ',' : '' ) . '?';
			$cptCol++;
		}

		$colonnes .=")";
		$parametres .= ")";

		return $requete . $colonnes . $parametres;
	}

	/***********************************/
	/*        Fonctions UPDATE         */
	/***********************************/

	public function update( $nomTable, $objet )
	{
		$requete = $this->constructionRequeteUpdate ( $nomTable, $objet );
		$tparam  = array ( );

		foreach( $objet->getEqAttributs ( ) as $cle => $valeur )
		{
			$tparam[] = $valeur;
		}

		return $this->execMaj( $requete,$tparam );
	}

	private function constructionRequeteUpdate ( $nomClasse, $objet )
	{
		$requete    = 'UPDATE ' . DB::$schema.'.'.$nomClasse;
		$parametres = ' SET ';
		$conditions = ' WHERE ';

		$eqAttributs = $objet->getEqAttributs ( );
		$cptAttribut = 0;
		foreach ( $eqAttributs as $cle => $valeur )
		{
			$cptAttribut++;
			$parametres .= $cle . ' = ?';
			if ( $cptAttribut < count ( $eqAttributs ) ) $parametres .= ', ';
		}

		$eqClesPrimaires = $objet->getEqClesPrimaires ( );
		$cptCles = 0;
		foreach ( $eqClesPrimaires as $cle => $valeur )
		{
			$cptCles++;
			$conditions .= $cle . ' = ' . $valeur;
			if ( $cptCles < count( $eqClesPrimaires ) ) $conditions .= ' AND ';
		}
	
		return $requete . $parametres . $conditions;
	}
}
?>