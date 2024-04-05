<?php
	session_start ( );
	include "../../donnee/Utilisateurs";
	require "../../controleur/ControleurDB.inc.php";
	
	$nom      = isset ( $_REQUEST['nomUtilisateur'] ) ? $_REQUEST['nomUtilisateur'] : '';
	$password = isset ( $_REQUEST['mot_de_passe']   ) ? $_REQUEST['mot_de_passe']   : '';

	if ( $nom !== '' && $password !== '' )
	{
		if ( verification ( $nom, $password ) )
		{
			//TODO: récupérer le niveau de droit de l'utilisateur
			$un_utilisateur = new Utilisateur ( $nom, null, null );
			
			$_SESSION['utilisateur'] = serialize ( $un_utilisateur );
			
			header ( "Location: ../../vue/importer/importer.php" );
			exit ( );
		}
		else
		{
			header ( "Location: ../../vue/authentifier/authentifier.php" );
			exit ( );
		}
	}
	else
	{
		header ( "Location: ../../vue/authentifier/authentifier.php" );
		exit ( );
	}

	function verification ( $nom, $pass )
	{
		return true;
		$lstUtilisateur =  DB::getInstance ( )->selectAll ( "utilisateur" );

		foreach ( $lstUtilisateur as $utilisateur )
		{
			$nomUtilisateur = $utilisateur->getNomUtilisateur ( );
			$motDePasse     = $utilisateur->getMdp            ( );

			if ( strcmp ( $nomUtilisateur, $nom ) && password_verify ( $pass, $motDePasse ) )
				return true;

		}

		return false;
	}
?>