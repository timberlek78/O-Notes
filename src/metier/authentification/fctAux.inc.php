<?php

session_start ( );

function validerSession ( )
{
	if( ! isset ( $_SESSION['utilisateur'] ) )
	{
		header ( "Location: ../../vue/authentifier/authentifier.php" );
	}
}
?>