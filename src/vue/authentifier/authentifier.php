<?php
	include "../../metier/authentification/fctAux.inc.php";
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="authentifier.css">
		<title>Pop-Up authentification</title>
	</head>
	<body>
		
		<div class="conteneur-authentifier">
			<div class="conteneur-image-profil">
				<svg class="photoProfile" width="16.88vw" height="16.74vh" viewBox="0 0 155 155" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="77.5" cy="77.5" r="77.5" fill="var(--orange-peps)"/>
					<circle cx="77.5" cy="57.5" r="19" stroke="white" stroke-width="3"/>
					<path d="M77 78.5C98.313 78.5 115.684 95.3798 116.472 116.5H78H37.528C38.3165 95.3798 55.687 78.5 77 78.5Z" fill="var(--orange-peps)" stroke="white" stroke-width="3"/>
				</svg>
			</div>
			
			<form action="../../metier/authentification/gestionLogin.php" method="post">
				<div class="conteneur-connexion">
					<div class="champs-saisie">
						<svg width="64" height="7.46vh" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect width="64" height="7.46vh" rx="12" fill="#D9D9D9"/>
							<circle cx="32.2912" cy="24.5656" r="6.56557" fill="#515151"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M45.2623 45.388C45.2623 38.1358 39.3833 30.811 32.1311 30.811C24.879 30.811 19 38.1358 19 45.388H32.1311H45.2623Z" fill="#515151"/>
						</svg>
							
						<input                type="text"     name="nomUtilisateur" value="" placeholder="Nom d'utilisateur" required>
					</div>

					<div class="champs-saisie">
						<svg width="64" height="7.46vh" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect width="64" height="7.46vh" rx="12" fill="#D9D9D9"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M26 21.5V26.0062C25.2531 26.0169 24.5856 26.0456 24.0083 26.1232C23.0251 26.2554 22.0825 26.5535 21.318 27.318C20.5535 28.0825 20.2554 29.025 20.1232 30.0083C19.9999 30.9258 19.9999 32.0715 20 33.4013V39.5987C19.9999 40.9284 19.9999 42.0741 20.1232 42.9917C20.2554 43.9749 20.5535 44.9175 21.318 45.6819C22.0825 46.4465 23.0251 46.7445 24.0083 46.8768C24.9258 47.0001 26.0715 47.0001 27.4013 47H36.5988C37.9284 47.0001 39.0741 47.0001 39.9917 46.8768C40.9749 46.7445 41.9175 46.4465 42.6819 45.6819C43.4465 44.9175 43.7445 43.9749 43.8768 42.9917C44.0001 42.0741 44.0001 40.9284 44 39.5987V33.4013C44.0001 32.0715 44.0001 30.9258 43.8768 30.0083C43.7445 29.025 43.4465 28.0825 42.6819 27.318C41.9175 26.5535 40.9749 26.2554 39.9917 26.1232C39.4145 26.0456 38.7468 26.0169 38 26.0062V21.5C38 19.0147 35.9853 17 33.5 17H30.5C28.0147 17 26 19.0147 26 21.5ZM30.5 20C29.6715 20 29 20.6716 29 21.5V26H35V21.5C35 20.6716 34.3284 20 33.5 20H30.5ZM32 33.5C30.3431 33.5 29 34.8431 29 36.5C29 38.1569 30.3431 39.5 32 39.5C33.6569 39.5 35 38.1569 35 36.5C35 34.8431 33.6569 33.5 32 33.5Z" fill="#515151"/>
						</svg>

						<input                type="password" name="mot_de_passe"            placeholder="**************" required>
					</div>

					<input class="bouton" type="submit"   name="ok"             value="SE CONNECTER">
				</div>
			</form>
		</div>
	</body>
</html>