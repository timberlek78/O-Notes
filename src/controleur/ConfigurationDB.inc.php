<?php

require '../../../lib/vendor/autoload.php';
use Dotenv\Dotenv;

class ConfigurationDB
{
	public $host;
	public $port;
	public $user;
	public $pass;
	
	public function __construct( )
	{
		$dotenv = Dotenv::createImmutable( __DIR__ );
		$dotenv->load( );

		$dotenv->required( [ 'DB_HOST', 'DB_PORT', 'DB_USER', 'DB_PASS' ] );

		$this->host = $_ENV[ 'DB_HOST' ];
		$this->port = $_ENV[ 'DB_PORT' ];
		$this->user = $_ENV[ 'DB_USER' ];
		$this->pass = $_ENV[ 'DB_PASS' ];
	}

	public function __toString( )
	{
		return 	"<ul>".
			"<li>host: $this->host </li>". 
			"<li>port: $this->port </li>".
			"<li>user: $this->user </li>".
			"<li>pass: $this->pass </li></ul>";
	}

	private static function test( )
	{
		$configuration = new ConfigurationDB( );
		echo $configuration;
	}
}
?>
