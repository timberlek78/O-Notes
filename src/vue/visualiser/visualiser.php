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
	<title>O'Notes</title>
	<link rel="stylesheet" href="visualiser.css">
	<link rel="stylesheet" href="tableau_note.css">
	<link rel="stylesheet" href="popup.css">
	<link rel="stylesheet" href="btnAnnee.css">
	<link rel="stylesheet" href="popupEditionEtudiant.css">
	<link rel="stylesheet" href="navigationSemestre.css">
	<link rel="stylesheet" href="popupCompetence.css">
</head>
<body>
<div class="conteneur"><div class="navbar"><div class="logo"><img src="../ressources/logo.png" alt="Logo Menu"/></div><div class="menu"><ul><li><a href="../importer/importer.php">Importation</a></li><li><a href="../visualiser/visualiser.php">Visualisation</a></li><li><a href="../exporter/exporter.php">Exportation</a></li></ul></div><div class="contient-button"><div class="button"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_168_56)"><circle cx="9.70603" cy="4.79451" r="4.79451" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M19.178 19.9998C19.178 14.7039 14.8849 9.35498 9.58901 9.35498C4.29315 9.35498 0 14.7039 0 19.9998H9.58901H19.178Z" fill="white"/></g><defs><clipPath id="clip0_168_56"><rect width="20" height="20" fill="white"/></clipPath></defs></svg><a href="#" class="connecter"><?php echo $un_utilisateur->getNomUtilisateur();?></a></div></div></div></div>		<div class="conteneur-visualiser">
			<select name="" id="choix-annee" class="btn-pied">
				<option value="" disabled selected>Année</option>
			</select>
			<div class="navigation-semestre">
				<button class="semestre btn-pied" id="s1">S1</button>
				<button class="semestre btn-pied" id="s2">S2</button>
				<button class="semestre btn-pied" id="s3">S3</button>
				<button class="semestre btn-pied" id="s4">S4</button>
				<button class="semestre btn-pied" id="s5">S5</button>
				<button class="semestre btn-pied" id="s6">S6</button>
			</div>
			<div class="popup-etudiant">
				<div>
					<button class="fermeture">X</button>
				</div>
				<div class="edition">
					<svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.9769 3.43802L3.13284 16.2821L15.9769 3.43802ZM15.9769 3.43802L19.9906 7.4518L15.9769 3.43802ZM15.9769 3.43802L17.5824 1.83252C18.0257 1.38916 18.7446 1.38916 19.1879 1.83252L21.5961 4.24078C22.0396 4.68413 22.0396 5.40295 21.5961 5.84629L19.9906 7.4518M7.14661 20.2959L3.13284 16.2821L7.14661 20.2959ZM7.14661 20.2959L19.9906 7.4518L7.14661 20.2959ZM7.14661 20.2959L1.92871 21.5L3.13284 16.2821" fill="#5B374D"/>
						<path d="M15.9769 3.43802L3.13284 16.2821M15.9769 3.43802L19.9906 7.4518M15.9769 3.43802L17.5824 1.83252C18.0257 1.38916 18.7446 1.38916 19.1879 1.83252L21.5961 4.24078C22.0396 4.68413 22.0396 5.40295 21.5961 5.84629L19.9906 7.4518M3.13284 16.2821L7.14661 20.2959M3.13284 16.2821L1.92871 21.5L7.14661 20.2959M19.9906 7.4518L7.14661 20.2959" stroke="var(--selectionne-couleur)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
				</div>
				<div class="cadre-image-etudiant">
					<div class="conteneur-image">
						<img class="photo-etudiant" alt="photo-etudiant" src="../../../res/image/image.png">
					</div>
					<div class="conteneur-information">
						<p id="popup-prenom">Prénom</p>
						<p id="popup-nom">Nom</p>
					</div>
				</div>
				<div class="conteneur-cadre-infos">
					<div class="cadre-info">
						<p>Code NIP</p>
						<p></p>
					</div>
					<div class="cadre-info">
						<p>Parcours</p>
						<p></p>
					</div>
					<div class="cadre-info">
						<p>Promotion</p>
						<p></p>
					</div>
					<div class="cadre-info">
						<p>BAC</p>
						<p></p>
					</div>
					<div class="cadre-info">
						<p>Spécialités</p>
						<p></p>
					</div>
					<div class="cadre-info">
						<p>Rang</p>
						<p></p>
					</div>
					<div class="cadre-info">
						<p>Absence(s) injustifiée(s)</p>
						<p></p>
					</div>
				</div>
			</div>
			<div class="conteneur-tableau-etd">
				<div class="liste-etd">
					<table class="tableau-nom-etd">
						<thead>
							<tr class="header">
								<th>Nom</th>
								<th>Prénom</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="conteneur-tableau-note">
				<div class="liste-note">
					<table class="tableau-note-etd">
						<thead>
							
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<div class="popup-competence-etd">
						<div>
							<button class="fermetureCompt">X</button>
						</div>
						<table class="tableau-competence-etd">
							
							<thead>

							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div id="popup-edition-etudiant">
			<div class="titre-popup">Avis de poursuite d'étude</div>
			<div class="identite-etd">Nom Prénom</div>
			<div class="avis-ecoles">
				<div class="avis-ecole">
					<p>Avis école d'ingénieurs</p>
					<select name="" id="selection-avis" class="entree">
						<option value="" disabled selected>Choisir un avis</option>
		
						<option value="TF">Très favorable </option>
						<option value="F"> Favorable      </option>
						<option value="AF">Assez favorable</option>
						<option value="SA">Sans avis      </option>
						<option value="R"> Réservé        </option>
					</select>
				</div>
				<div class="avis-ecole">
					<p>Avis master</p>
					<select name="" id="selection-avis" class="entree">
						<option value="" disabled selected>Choisir un avis</option>
		
						<option value="TF">Très favorable </option>
						<option value="F"> Favorable      </option>
						<option value="AF">Assez favorable</option>
						<option value="SA">Sans avis      </option>
						<option value="R"> Réservé        </option>
					</select>
				</div>
			</div>
	
			<div class="commentaire">
				<div class="sous-titre">Commentaire</div>
				<textarea name="commentaire" id="txt-commentaire" class="entree" cols="30" rows="5"></textarea>
			</div>
	
			<div class="btns-popup">
				<button class="btn-annuler btn-popup">Annuler</button>
				<button class="btn-valider btn-popup">Valider</button>
			</div>
		</div>
	</div>

	<script src="./genererTableau.js"></script>
	<script src="./visualiser.js"></script>
	<script src="./popupCompetence.js"></script>
	<script src="./popupEtudiant.js"></script>
	<script src="./popupEditionEtudiant.js"></script>
</body>
</html>
