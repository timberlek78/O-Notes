<?php
	session_start ( );
	//include "utilisateur.inc.php";
	require "../../controleur/ControleurDB.inc.php";
	
	$nom      = isset ( $_REQUEST['nomUtilisateur'] ) ? $_REQUEST['nomUtilisateur'] : '';
	$password = isset ( $_REQUEST['mot_de_passe']   ) ? $_REQUEST['mot_de_passe']   : '';

	if ( $nom !== '' && $password !== '' )
	{
		if ( verification ( $nom, $password ) )
		{
			header ("Location: ../../vue/importer/importer.html" );

			$un_utilisateur = new Utilisateur ( $nom, niveauDroit ( $nom ) );

			$_SESSION['utilisateur'] = serialize ( $un_utilisateur );

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
		echo password_hash("Equipe8-ONote", PASSWORD_DEFAULT, []);

		if ( password_verify ( "Equipe8-ONote", '$2y$10$eRRKrMsK.PY0d3NQrY1n0ezrU2IqpN7/6gdS.k6HAykdJrykFU6K.'))
			echo " sqd" ;
		
		$lstUtilisateur =  DB::getInstance ( )->selectAll ( "utilisateur" );

		foreach ( $lstUtilisateur as $utilisateur )
		{
			$nomUtilisateur = $utilisateur->getNomUtilisateur ( );
			$motDePasse     = $utilisateur->getMdp            ( );

			if ( strcmp ( $nomUtilisateur, $nom ) && password_verify ( $pass, $motDePasse ) )
			{
				return true;
			}
		}

		return false;
	}
?>