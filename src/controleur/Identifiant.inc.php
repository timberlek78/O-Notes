<?php

require '../../lib/vendor/autoload.php';
use Dotenv\Dotenv;

class Identifiant
{
	public static $user;
	public static $mdp;

	public function __construct( )
	{
		$dotenv = Dotenv::createImmutable( __DIR__ );
		$dotenv->load( );

		self::$user = getenv( 'DB_USER' );
		self::$mdp = getenv( 'DB_PASS' );
	}
}

// Utilisation de la classe Identifiant pour obtenir les identifiants
$identifiant = new Identifiant();
echo "Utilisateur: " . Identifiant::$user . "<br>";
echo "Mot de passe: " . Identifiant::$mdp . "<br>";
?>
