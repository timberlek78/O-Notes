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

	function verification ( $nom, $pass )
	{
		$lstUtilisateur =  DB::getInstance ( )->selectAllWhere ( "utilisateur", 'nomutilisateur', $nom );

		foreach ( $lstUtilisateur as $utilisateur )
		{
			$motDePasse     = $utilisateur->getMdp            ( );
			$acces          = $utilisateur->getAcces          ( );

			if ( password_verify ( $pass, $motDePasse ) )
			{
				return new Utilisateur ( $nom, $motDePasse, $acces );
			}
		}
		return null;
	}
?>