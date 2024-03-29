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

