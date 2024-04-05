<?php

include "../../metier/authentification/fctAux.inc.php";
include "../../donnee/dao/Utilisateur.inc.php";

validerSession ( );
$un_utilisateur = unserialize ( $_SESSION['utilisateur'] );

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="exporter.css">
	<title>Exporter</title>
</head>
<body>
	<div class="conteneur">
		<div class="navbar">
			<div class="logo">
				<img src="../ressources/logo.png" alt="Logo Menu"/>
			</div>
			<div class="menu">
				<ul>
					<li><a href="../importer/importer.php">Importation</a></li>
					<li><a href="../visualiser/visualiser.php">Visualisation</a></li
					><li><a href="../exporter/exporter.php">Exportation</a></li>
				</ul>
			</div>
			<div class="contient-button">
				<form action="../../metier/authentification/bye.php" method="post">
					<button class="exit">
						<div class="button">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_168_56)"><circle cx="9.70603" cy="4.79451" r="4.79451" fill="white"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M19.178 19.9998C19.178 14.7039 14.8849 9.35498 9.58901 9.35498C4.29315 9.35498 0 14.7039 0 19.9998H9.58901H19.178Z" fill="white"/>
							</g>
									<defs>
										<clipPath id="clip0_168_56"><rect width="20" height="20" fill="white"/>
									</clipPath>
								</defs>
							</svg>
							<a class="connecter"><?php echo $un_utilisateur->getNomUtilisateur()?></a>
						</div>
					</button>
				</form>
			</div>
		</div>
	</div>

	<div class="selection-annee">
		<select name="" id="choix-annee" class="btn-pied">
			<option value="" disabled selected>Année</option>
		</select>
	</div>
	<div class="conteneur-export">
	</div>

	<div class="pied-de-page">
		<button class="btn-avis-poursuite btn-pied">
			Avis de poursuite
		</button>
		<button class="btn-jury btn-pied">
			Fiche jury
		</button>
	</div>

	<!------------------------------------>
	<!-- Pop-Up Génération avis du jury -->
	<!-- --------------------------------->

	<div id="popup-avis-poursuite">
		<div class="titre-popup">Avis de poursuite d'étude</div>
		<div class="selection-nom-chef-dep">
			<div class="sous-titre">Nom du chef de département</div>
			<input type="text" name="nom-chef-dep" id="entree-texte">
		</div>

		<div class="images-import">
			<div class="sous-titre">Images à importer</div>
			<div class="btn-imports">
				<div class="ajout-document ajout-logo-un">
					<svg id="svg-logo-un" width="155" height="40" viewBox="0 0 155 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" width="154" height="40" rx="12" fill="var(--orange-peps)"/>
						<path id="svg-design" fill-rule="evenodd" clip-rule="evenodd" d="M89.375 34V11.5H80.375V13.75H87.125V31.75H66.875V13.75H73.625V11.5H64.625V34H89.375ZM75.875 19.375H71.375L77 26.125L82.625 19.375H78.125V7H75.875V19.375Z" fill="white"/>
					</svg>
					Logo 1
					<input type="file" name="" id="entree-logo-un" style="display: none;">
				</div>
				<div class="ajout-document ajout-logo-deux">
					<svg id="svg-logo-deux" width="155" height="40" viewBox="0 0 155 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" width="154" height="40" rx="12" fill="var(--orange-peps)"/>
						<path id="svg-design" fill-rule="evenodd" clip-rule="evenodd" d="M89.375 34V11.5H80.375V13.75H87.125V31.75H66.875V13.75H73.625V11.5H64.625V34H89.375ZM75.875 19.375H71.375L77 26.125L82.625 19.375H78.125V7H75.875V19.375Z" fill="white"/>
					</svg>
					Logo 2
					<input type="file" name="" id="entree-logo-deux" style="display: none;">
				</div>
				<div class="ajout-document ajout-signature">
					<svg id="svg-signature" width="155" height="40" viewBox="0 0 155 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" width="154" height="40" rx="12" fill="var(--orange-peps)"/>
						<path id="svg-design" fill-rule="evenodd" clip-rule="evenodd" d="M89.375 34V11.5H80.375V13.75H87.125V31.75H66.875V13.75H73.625V11.5H64.625V34H89.375ZM75.875 19.375H71.375L77 26.125L82.625 19.375H78.125V7H75.875V19.375Z" fill="white"/>
					</svg>
					Signature
					<input type="file" name="" id="entree-signature" style="display: none;">
				</div>
			</div>
		</div>

		<div class="btns-popup">
			<button class="btn-annuler btn-popup">Annuler</button>
			<button class="btn-valider btn-popup">Valider</button>
		</div>
	</div>

	<!------------------------------------>
	<!-- Pop-Up Génération JURY         -->
	<!-- --------------------------------->

	<div id="popup-jury">
		<div class="titre-popup">Fiche de jury</div>
		<div class="selection-nom-chef-dep">
			<div class="sous-titre">Sélectionner un semestre à exporter</div>
			<select name="" id="entree-semestre">
				<option value="default" disabled selected>Semestre</option>
				<option value="S1">S1</option>
				<option value="S2">S2</option>
				<option value="S3">S3</option>
				<option value="S4">S4</option>
				<option value="S5">S5</option>
				<option value="S6">S6</option>
			</select>
		</div>

		<div class="btns-popup">
			<button class="btn-annuler-jury btn-popup">Annuler</button>
			<button class="btn-valider-jury btn-popup">Valider</button>
		</div>
	</div>

	<script src="exporter.js"></script>

</body>
</html>