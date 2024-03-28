const popupImportation = document.getElementById("popup-ajout-semestre");
const btnAjouterSem    = document.querySelector(".btn-ajout-semestre");
const btnAnnuler       = document.querySelector(".btn-annuler");

btnAjouterSem.onclick = function()
{
	popupImportation.classList.add('open');
}

btnAnnuler.onclick = function()
{
	popupImportation.classList.remove('open');
}

window.onclick = function(event)
{
	if (event.target === popupImportation)
	{
		popupImportation.classList.remove('open');
	}
}

