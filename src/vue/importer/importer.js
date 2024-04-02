const popupImportation = document.getElementById("popup-ajout-semestre");
const btnAjouterSem    = document.querySelector(".btn-ajout-semestre");
const btnAnnuler       = document.querySelector(".btn-annuler");

btnAjouterSem.onclick = function()
{
	popupImportation.classList.add('ouvert');
}

btnAnnuler.onclick = function()
{
	popupImportation.classList.remove('ouvert');
}

window.onclick = function(event)
{
	if (event.target === popupImportation)
	{
		popupImportation.classList.remove('ouvert');
	}
}

selectionJury = document.querySelector ('.ajout-jury');
inputFileJury = document.getElementById('entree-jury');

selectionSemestre = document.querySelector ('.ajout-semestre');
inputFileSemestre = document.getElementById('entree-semestre');

selectionJury.    addEventListener('click', function() 
{
	inputFileJury.click();
});

selectionSemestre.addEventListener('click', function()
{
	inputFileSemestre.click();
});

console.log('coucou wanou')

inputFileJury    .addEventListener('change', function()
{
	fichierJury = inputFileJury.files[0];

	if (fichierJury)
	{
		svgJury = document.getElementById('svg-jury');

		var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
		text.setAttribute('x', '50%'); // Définir la position horizontale du texte
		text.setAttribute('y', '50%'); // Définir la position verticale du texte
		text.setAttribute('text-anchor', 'middle'); // Aligner le texte au centre
		text.setAttribute('dominant-baseline', 'middle'); // Aligner le texte verticalement au centre
		text.setAttribute('fill', 'white'); // Couleur du texte
		text.setAttribute('font-size', '12'); // Taille de la police
		text.textContent = fichierJury.name; // Contenu du texte

		// svgJury.querySelector('path').style.display = 'none';

		svgJury.replaceChild(text, svgJury.querySelector('path'))
		console.log('Fichier bon')
	}
	else
	{
		console.log("JURY : Le fichier est introuvable")
	}
});

inputFileSemestre    .addEventListener('change', function()
{
	fichierSemestre = inputFileSemestre.files[0];

	if (fichierSemestre)
	{
		svgSemestre = document.getElementById('svg-semestre');

		var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
		text.setAttribute('x', '50%'); // Définir la position horizontale du texte
		text.setAttribute('y', '50%'); // Définir la position verticale du texte
		text.setAttribute('text-anchor', 'middle'); // Aligner le texte au centre
		text.setAttribute('dominant-baseline', 'middle'); // Aligner le texte verticalement au centre
		text.setAttribute('fill', 'white'); // Couleur du texte
		text.setAttribute('font-size', '12'); // Taille de la police
		text.textContent = fichierSemestre.name; // Contenu du texte

		// svgSemestre.querySelector('path').style.display = 'none';

		svgSemestre.replaceChild(text, svgSemestre.querySelector('path'))
		console.log('Fichier bon')
	}
	else
	{
		console.log("SEMESTRE : Le fichier est introuvable")
	}
});

// inputFileSemestre.addEventListener('change', verifierFichier(inputFileSemestre))