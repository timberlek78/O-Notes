/* CREATION DES ENCADRES */

function fetchAnneeData(annee)
{
	fetch('../../controleur/ControleurVue.inc.php?annee=' + annee)
		.then (reponse => reponse.json())
		.then (donnees =>
			{
				console.log(donnees);
			})
		.catch (erreur => console.error('Erreur lors du fetch'))
}


/************************************/

const popupExportation = document.getElementById("popup-avis-poursuite");
const btnValider       = document.querySelector(".btn-valider");
const btnAnnuler       = document.querySelector(".btn-annuler");
const btnAvis          = document.querySelector(".btn-avis-poursuite")

btnAvis.onclick = function()
{
	popupExportation.classList.add('ouvert');
}

btnAnnuler.onclick = fermerPopUp ;
btnValider.onclick = fermerPopUp;

function fermerPopUp ( )
{
	popupExportation.classList.remove('ouvert');
}

/*
	<div class="cadre-export">
		<div class="conteneur-image-etudiant">
			<img class="photo-etudiant" alt="photo-etudiant" src="../../..../../../res/image/image.png">
		</div>
		<div class="conteneur-information">
			<p>Prénom</p>
			<p>Antunel-Celia_yanis</p>
		</div>
	</div>
*/