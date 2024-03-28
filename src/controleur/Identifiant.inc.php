<?php
class Identifiant
{
	public static $user;
	public static $mdp;

	public function __construct()
	{
		$fichier = 'login.txt';
		$ressource = fopen($fichier, 'rb');

		self::$user = fgets($ressource);
		self::$mdp  = fgets($ressource);

		fclose($ressource);
	}
}
?>
