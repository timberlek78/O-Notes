<?php

include "../../metier/authentification/fctAux.inc.php";

validerSession ( );
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="importer.css">
	<title>O'Notes</title>
</head>
<body>
<div class="conteneur"><div class="navbar"><div class="logo"><img src="../ressources/logo.png" alt="Logo Menu"/></div><div class="menu"><ul><li><a href="../importer/importer.php">Importation</a></li><li><a href="../visualiser/visualiser.php">Visualisation</a></li><li><a href="../exporter/exporter.php">Exportation</a></li></ul></div><div class="contient-button"><div class="button"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_168_56)"><circle cx="9.70603" cy="4.79451" r="4.79451" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M19.178 19.9998C19.178 14.7039 14.8849 9.35498 9.58901 9.35498C4.29315 9.35498 0 14.7039 0 19.9998H9.58901H19.178Z" fill="white"/></g><defs><clipPath id="clip0_168_56"><rect width="20" height="20" fill="white"/></clipPath></defs></svg><a href="#" class="connecter">Nom utilisateur</a></div></div></div></div>
	<div class="conteneur-import">
		
	</div>

	<div class="bienvenue">
		<p>Merci d'importer vos fichiers.</p>
	</div>

	<div class="chargement">
		<div class="roue-chargement"></div>
	</div>

	<!-- Pop-up -->
	<div id="popup-ajout-semestre">
		<div class="titre-popup">Ajout d'un semestre</div>
		<div class="selection-periode">
			<div class="selection-annee">
				<div class="sous-titre">Année</div>
				<input type="text" id="choix-annee" placeholder="YYYY-YYYY">
			</div>
			<div class="selection-semestre">
				<div class="sous-titre">Semestre</div>
				<select name="" id="choix-semestre">
					<option value="default" disabled selected>Choisir un semestre</option>
	
					<option value="S1">            S1            </option>
					<option value="S2">            S2            </option>
					<option value="S3">            S3            </option>
					<option value="S4">            S4            </option>
					<option value="S5">            S5            </option>
					<option value="S5 - Alternant">S5 - Alternant</option>
					<option value="S6">            S6            </option>
					<option value="S6 - Alternant">S6 - Alternant</option>
				</select>
		</div>
		</div>

		<div class="documents-import">
			<div class="sous-titre">Documents à importer</div>
			<div class="btn-imports">
				<div class="ajout-document ajout-jury">
					<svg id="svg-jury" width="155" height="40" viewBox="0 0 155 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" width="154" height="40" rx="12" fill="var(--orange-peps)"/>
						<path id="svg-design" fill-rule="evenodd" clip-rule="evenodd" d="M89.375 34V11.5H80.375V13.75H87.125V31.75H66.875V13.75H73.625V11.5H64.625V34H89.375ZM75.875 19.375H71.375L77 26.125L82.625 19.375H78.125V7H75.875V19.375Z" fill="white"/>
					</svg>
					Jury

					<input type="file" name="" id="entree-jury" style="display: none;">
				</div>
				<div class="ajout-document ajout-moyenne">
					<svg id="svg-moyenne" width="155" height="40" viewBox="0 0 155 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" width="154" height="40" rx="12" fill="var(--orange-peps)"/>
						<path id="svg-design" fill-rule="evenodd" clip-rule="evenodd" d="M89.375 34V11.5H80.375V13.75H87.125V31.75H66.875V13.75H73.625V11.5H64.625V34H89.375ZM75.875 19.375H71.375L77 26.125L82.625 19.375H78.125V7H75.875V19.375Z" fill="white"/>
					</svg>
					Moyenne

					<input type="file" name="" id="entree-moyenne" style="display: none;">
				</div>
			</div>
		</div>

		<div class="btns-popup">
			<button class="btn-annuler btn-popup">Annuler</button>
			<button class="btn-valider btn-popup">Valider</button>
		</div>
	</div>

	<div class="pied-de-page">
		<div class="ajouts">
			<button class="btn-ajout-semestre btn-pied">
				Ajouter un semestre
			</button>
			<button class="btn-ajout-coeff btn-pied">
				Ajouter les coefficients
				<input type="file" name="" id="entree-coeff" style="display: none;">
			</button>
		</div>
		<button class="btn-import btn-pied">
			Importer
		</button>
	</div>
	<script src="importer.js"></script>

	
</body>

</html>