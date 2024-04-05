/* Lecture des années renseignées */
fetch ('../../controleur/ControleurVue.inc.php?anneesRenseignees=true')
	.then ( reponse => reponse.json ( ) )
	.then ( donnees => 
		{
			donnees.forEach ( function ( donnee )
			{
				creerOption ( donnee );
			} );
		})
	.catch ( erreur => console.error ( erreur ) )

/* Placement des années dans la sélection */
const choixAnnee = document.getElementById('choix-annee');
function creerOption ( annee )
{
	console.log(annee);
	option = document.createElement('option');
	option.value = annee;
	option.innerText = annee;

	choixAnnee.appendChild ( option );
}

var anneeChoisie;
choixAnnee.addEventListener('change', function()
{
	anneeChoisie = choixAnnee.value;
	fetchAnneeData(anneeChoisie)
	reinitialiserPage();
})


/* FETCH DES DONNEES */
function fetchAnneeData( annee )
{
	fetch ( '../../controleur/ControleurVue.inc.php?annee=' + annee )
		.then ( reponse => reponse.json ( ) )
		.then ( donnees =>
			{
				donnees.forEach ( function ( etudiant )
				{
					creerEncadre ( etudiant );
				} );
			})
		.catch ( erreur => console.error ( erreur ) )
}

/* CREATION DES ENCADRES */
function creerEncadre ( jsonEtudiant )
{
	const conteneurExport = document.querySelector ( '.conteneur-export' );

	conteneurCadreExport = document.createElement ( 'div' );
	conteneurCadreExport.classList.add ( 'cadre-export' );

	conteneurExport.appendChild ( conteneurCadreExport );

	// Création de la div conteneur-image-etudiant
	conteneurImageEtudiant = document.createElement ( 'div' );
	conteneurImageEtudiant.classList.add ( 'conteneur-image-etudiant' );

	conteneurCadreExport.appendChild ( conteneurImageEtudiant );

	// Création de l'image de profil
	conteneurImageEtudiant.innerHTML = '<img class="photo-etudiant" alt="photo-etudiant" src="../../../res/image/PERSONA.jpg"></img>';
	
	// Création de la div conteneur-information
	conteneurInformation = document.createElement ( 'div' );
	conteneurInformation.classList.add ( 'conteneur-information' );

	if ( jsonEtudiant.fpeRenseignee )
	{
		conteneurInformation.classList.add ( 'selectionne' );
	}

	conteneurCadreExport.appendChild ( conteneurInformation );

	// Création des paragraphes des informations
	pPrenom = document.createElement ( 'p' );
	pPrenom.innerText = jsonEtudiant.prenom;

	pNom    = document.createElement ( 'p' );
	pNom   .innerText = jsonEtudiant.nom;

	conteneurInformation.appendChild( pPrenom );
	conteneurInformation.appendChild( pNom    );
}

function reinitialiserPage()
{
	const conteneurExport = document.querySelector ( '.conteneur-export' );
	conteneurExport.innerHTML = "";
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
btnValider.onclick = exporterAvis;

function fermerPopUp ( )
{
	popupExportation.classList.remove('ouvert');
}

/*Récupération des fichiers*/
var fichierLogoUn;
var fichierLogoDeux;
var fichierSignature;

selectionLogoUn = document.querySelector ('.ajout-logo-un');
inputFileLogoUn = document.getElementById('entree-logo-un');

selectionLogoUn.addEventListener('click', function() 
{
	inputFileLogoUn.click();
});

selectionLogoDeux = document.querySelector ('.ajout-logo-deux');
inputFileLogoDeux = document.getElementById('entree-logo-deux');

selectionLogoDeux.addEventListener('click', function() 
{
	inputFileLogoDeux.click();
});

selectionSignature = document.querySelector ('.ajout-signature');
inputFileSignature = document.getElementById('entree-signature');

selectionSignature.addEventListener('click', function() 
{
	inputFileSignature.click();
});

inputFileLogoUn.addEventListener('change', function()
{
	fichierLogoUn = inputFileLogoUn.files[0];

	if (fichierLogoUn)
	{
		svg = document.getElementById('svg-logo-un');

		remplacerFichier(svg, fichierLogoUn)
	}
});

inputFileLogoDeux.addEventListener('change', function()
{
	fichierLogoDeux = inputFileLogoUn.files[0];

	if (fichierLogoDeux)
	{
		svg = document.getElementById('svg-logo-deux');

		remplacerFichier(svg, fichierLogoDeux)
	}
});

inputFileSignature.addEventListener('change', function()
{
	fichierSignature = inputFileSignature.files[0];

	if (fichierSignature)
	{
		svg = document.getElementById('svg-signature');

		remplacerFichier(svg, fichierSignature)
	}
});

/* VALIDATION DE L'AVIS DE POURSUITE D'ETUDE */
function exporterAvis ( )
{
	const entreeChef = document.getElementById('entree-texte');
	chefSaisi = entreeChef.value;

	if (!verifierPopupAvis(chefSaisi)) return;

	formData = new FormData();

	formData.append('chefDept', chefSaisi);
	formData.append('fichierLogoUn', fichierLogoUn),
	formData.append('fichierLogoDeux', fichierLogoDeux);
	formData.append('fichierSignature', fichierSignature);

	fetch ( '../../controleur/ControleurVue.inc.php',
	{
		method: 'POST',
		body: formData
	})
	.then ( reponse => reponse.json())
	.catch ( erreur => 
		{
			console.log ( erreur );
		})
}

function verifierPopupAvis(chef)
{
	if (!chef)
	{
		alert('Un chef de département doit être saisi');
		return false;
	}

	if (!fichierLogoUn || !fichierLogoDeux || !fichierSignature)
	{
		alert('Veuillez renseigner tous les documents.');
		return false;
	}

	return true;
}

function remplacerFichier ( svg, fichier )
{
	var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
	text.setAttribute('x', '50%'); // Définir la position horizontale du texte
	text.setAttribute('y', '50%'); // Définir la position verticale du texte
	text.setAttribute('text-anchor', 'middle'); // Aligner le texte au centre
	text.setAttribute('dominant-baseline', 'middle'); // Aligner le texte verticalement au centre
	text.setAttribute('fill', 'white'); // Couleur du texte
	text.setAttribute('font-size', '12'); // Taille de la police
	text.setAttribute('id', 'svg-design'); // Définir l'id du texte
	text.textContent = fichier.name; // Contenu du texte

	svg.replaceChild(text, svg.querySelector('#svg-design'))
}

btnJury = document.querySelector('.btn-jury');

btnJury.onclick = ouverturePopupJury;

const popupJury = document.getElementById('popup-jury');

btnAnnulerJury = document.querySelector('.btn-annuler-jury');
btnValiderJury = document.querySelector('.btn-valider-jury');

btnAnnulerJury.onclick = fermeturePopupJury;
btnValiderJury.onclick = exporterJury;

function ouverturePopupJury()
{
	popupJury.classList.add('ouvert');
}

function fermeturePopupJury()
{
	popupJury.classList.remove('ouvert');
}

function exporterJury()
{
	entreeSemestre = document.getElementById('entree-semestre');
	semestre = entreeSemestre.value;

	if (semestre === "default") return;

	annee = parseInt(parseInt(semestre.substring(1,2))/2+0.5);

	anneeFin = parseInt(anneeChoisie.substring(5, 9)) + (3-annee);

	promotion = anneeFin-3 + "-" + anneeFin;

	console.log('promo : ' + promotion);

	formData = new FormData();
	formData.append('promotion', promotion);
	formData.append('semestre',  parseInt(semestre.substring(1,2)));

	fetch ( '../../controleur/ControleurVue.inc.php',
	{
		method: 'POST',
		body: formData
	})
	.then ( reponse => console.log(reponse))
	.catch ( erreur => 
		{
			console.log ( erreur );
		})

	fermeturePopupJury();
}