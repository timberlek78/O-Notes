<?php
	session_start ( );
	include "../../donnee/dao/Utilisateur.inc.php";
	require "../../controleur/ControleurDB.inc.php";
	
	$nom      = isset ( $_REQUEST['nomUtilisateur'] ) ? $_REQUEST['nomUtilisateur'] : '';
	$password = isset ( $_REQUEST['mot_de_passe']   ) ? $_REQUEST['mot_de_passe']   : '';

	if ( $nom !== '' && $password !== '' )
	{
		$un_utilisateur = verification ( $nom, $password );
		if ( $un_utilisateur != null )
		{
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

	function verification ( $nom, $pass ) : Utilisateur
	{
		return new Utilisateur ( "fds", "dsfs", "dsfs" );
		$lstUtilisateur =  DB::getInstance ( )->selectAll ( "utilisateur" );

		foreach ( $lstUtilisateur as $utilisateur )
		{
			$nomUtilisateur = $utilisateur->getNomUtilisateur ( );
			$motDePasse     = $utilisateur->getMdp            ( );
			$acces          = $utilisateur->getAcces          ( );

			if ( strcmp ( $nomUtilisateur, $nom ) && password_verify ( $pass, $motDePasse ) )
			{
				return new Utilisateur ( $nomUtilisateur, $motDePasse, $acces );
			}
		}
		return null;
	}
?>