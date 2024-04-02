const popupImportation = document.getElementById("popup-ajout-semestre");
const btnAjouterSem    = document.querySelector(".btn-ajout-semestre");
const btnAnnuler       = document.querySelector(".btn-annuler");
const btnValider       = document.querySelector(".btn-valider");

btnAjouterSem.addEventListener('click', function()
{
	popupImportation.classList.add('ouvert');
});

btnAnnuler.addEventListener('click', function()
{
	popupImportation.classList.remove('ouvert');
});


btnValider.onclick = function()
{
	popupImportation.classList.remove('ouvert');

	const choixAnnee    = document.getElementById( 'choix-annee'    );
	const choixSemestre = document.getElementById( 'choix-semestre' );

	anneeChoisie   = choixAnnee   .value;
	semestreChoisi = choixSemestre.value;

	//TODO: Faire un json pour stocker les fichiers et les envoyer en php (voir avec chat gpt "Stocker fichiers en js...")
	console.log('Annee : ' + anneeChoisie + " Semestre : " + semestreChoisi);
}

/* SELECTION DES DOCUMENTS */

selectionJury = document.querySelector ('.ajout-jury');
inputFileJury = document.getElementById('entree-jury');

selectionMoyenne = document.querySelector ('.ajout-moyenne');
inputFileMoyenne = document.getElementById('entree-moyenne');

selectionJury.    addEventListener('click', function() 
{
	inputFileJury.click();
});

selectionMoyenne.addEventListener('click', function()
{
	inputFileMoyenne.click();
});

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

inputFileMoyenne    .addEventListener('change', function()
{
	fichierMoyenne = inputFileMoyenne.files[0];

	if (fichierMoyenne)
	{
		svgMoyenne = document.getElementById('svg-moyenne');

		var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
		text.setAttribute('x', '50%'); // Définir la position horizontale du texte
		text.setAttribute('y', '50%'); // Définir la position verticale du texte
		text.setAttribute('text-anchor', 'middle'); // Aligner le texte au centre
		text.setAttribute('dominant-baseline', 'middle'); // Aligner le texte verticalement au centre
		text.setAttribute('fill', 'white'); // Couleur du texte
		text.setAttribute('font-size', '12'); // Taille de la police
		text.textContent = fichierMoyenne.name; // Contenu du texte

		// svgMoyenne.querySelector('path').style.display = 'none';

		svgMoyenne.replaceChild(text, svgMoyenne.querySelector('path'))
		console.log('Fichier bon')
	}
	else
	{
		console.log("MOYENNE : Le fichier est introuvable")
	}
});

// inputFileSemestre.addEventListener('change', verifierFichier(inputFileSemestre))