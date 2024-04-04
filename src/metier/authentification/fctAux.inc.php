<?php

session_start ( );

function validerSession ( )
{
	if( ! isset ( $_SESSION['utilisateur'] ) )
	{
		header('Location: connexion.php');
	}
}
?>