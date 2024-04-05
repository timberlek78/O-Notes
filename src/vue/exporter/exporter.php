<?php

include "../../metier/authentification/fctAux.inc.php";

validerSession ( );
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
				<div class="ajout-document">
					<svg width="155" height="40" viewBox="0 0 155 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" width="154" height="40" rx="12" fill="var(--orange-peps)"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M89.375 34V11.5H80.375V13.75H87.125V31.75H66.875V13.75H73.625V11.5H64.625V34H89.375ZM75.875 19.375H71.375L77 26.125L82.625 19.375H78.125V7H75.875V19.375Z" fill="white"/>
					</svg>
					Logo 1
				</div>
				<div class="ajout-document">
					<svg width="155" height="40" viewBox="0 0 155 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" width="154" height="40" rx="12" fill="var(--orange-peps)"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M89.375 34V11.5H80.375V13.75H87.125V31.75H66.875V13.75H73.625V11.5H64.625V34H89.375ZM75.875 19.375H71.375L77 26.125L82.625 19.375H78.125V7H75.875V19.375Z" fill="white"/>
					</svg>
					Logo 2
				</div>
				<div class="ajout-document">
					<svg width="155" height="40" viewBox="0 0 155 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" width="154" height="40" rx="12" fill="var(--orange-peps)"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M89.375 34V11.5H80.375V13.75H87.125V31.75H66.875V13.75H73.625V11.5H64.625V34H89.375ZM75.875 19.375H71.375L77 26.125L82.625 19.375H78.125V7H75.875V19.375Z" fill="white"/>
					</svg>
					Signature
				</div>
			</div>
		</div>

		<div class="btns-popup">
			<button class="btn-annuler btn-popup">Annuler</button>
			<button class="btn-valider btn-popup">Valider</button>
		</div>
	</div>

	<script src="exporter.js"></script>

</body>
</html>