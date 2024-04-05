const popupImportation = document.getElementById("popup-ajout-semestre");
const btnAjouterSem    = document.querySelector(".btn-ajout-semestre");
const btnAnnuler       = document.querySelector(".btn-annuler");
const btnValider       = document.querySelector(".btn-valider");
const btnImporter      = document.querySelector(".btn-import");

// FICHIERS
var fichierJury;
var fichierMoyenne;

const tabFichiers = new FormData();
var   nbFD = 0;

//TODO: tableau de fichiers

btnAjouterSem.addEventListener('click', function()
{
	popupImportation.classList.add('ouvert');
});

btnAnnuler.addEventListener('click', function()
{
	popupImportation.classList.remove('ouvert');
});


btnValider.addEventListener('click', validationImport);

function validationImport ( )
{
	const choixAnnee    = document.getElementById( 'choix-annee'    );
	const choixSemestre = document.getElementById( 'choix-semestre' );
	
	anneeChoisie   = choixAnnee   .value;
	semestreChoisi = choixSemestre.value;

	if ( !verificationImport ( semestreChoisi, anneeChoisie ) ) return;

	// var formData = new FormData();
	// formData.append('annee', anneeChoisie);
	// formData.append('semestre', semestreChoisi);
	// formData.append('fichierJury', fichierJury);
	// formData.append('fichierMoyenne', fichierMoyenne);

	// Stockage des fichiers sous format json

	// tabFichiers.append('formData' + nbFD, formData); // Ajout du json au tableau de tous les json

	tabFichiers.append('annee[]', anneeChoisie);
	tabFichiers.append('semestre[]', semestreChoisi);
	tabFichiers.append('fichierJury[]', fichierJury);
	tabFichiers.append('fichierMoyenne[]', fichierMoyenne)

	console.log(nbFD);

	popupImportation.classList.remove ( 'ouvert' );       // Fermeture du popup
	
	//TODO: Faire un json pour stocker les fichiers et les envoyer en php (voir avec chat gpt "Stocker fichiers en js...")

	// Si premier import : retrait du message de bienvenue
	const bienvenue = document.querySelector ( '.bienvenue' );
	bienvenue.style.display = 'none';

	// Si premier import : affichage de la div contenant les cadres
	const conteneurImport = document.querySelector ( '.conteneur-import' );
	conteneurImport.style.display = 'grid';
	
	// Création de la div qui résume les informations
	creationCadreImport ( conteneurImport, semestreChoisi, anneeChoisie ) ;


	// Remettre à 0 le pop-up
	resetPopup ( );

	nbFD++;
}

function verificationImport(semestre, annee)
{
	anneeChoisieMatch = annee.match ( /^(\d{4})-(\d{4})$/ );

	if ( anneeChoisieMatch )
	{
		const anneeDebut = Number ( anneeChoisieMatch [ 1 ] );
		const anneeFin   = Number ( anneeChoisieMatch [ 2 ] );

		if ( anneeFin !== anneeDebut + 1 )
		{
			alert ( "L'année doit être au format 'AAAA-AAAA+1'. Exemple : 2005-2006" )
			return false;
		}
	}
	else
	{
		alert ( "L'année doit être au format 'AAAA-AAAA+1'. Exemple : 2005-2006" )
		return false;
	}

	//FIXME: valeur par défaut fonctionne
	if ( !semestre )
	{
		alert ( "Vous deves sélectionner un semestre" );
		return false;
	}

	if ( !fichierJury || !fichierMoyenne )
	{
		alert ( "Vous devez importer la totalité des fichiers demandés" );
		return false;
	}

	//FIXME:
	// let existeDeja = Array.from(tabFichiers.values()).some(valeur => fichier.annee === annee && fichier.semestre === semestre);

	// if (existeDeja)
	// {
	// 	alert ( "Des fichiers sont déjà importés pour le semestre " + semestre + " de l'année " + annee + ". Veuillez d'abord les supprimer." );
	// 	return false;
	// }

	return true;
}

function creationCadreImport(parent, semestre, annee)
{
	// Cadre contenant tout
	cadreImport = document.createElement ( 'div' );
	cadreImport.classList.add ( 'cadre-import' );
	cadreImport.classList.add ( 'index' + nbFD);
	parent.appendChild ( cadreImport );

	// Titre
	titreCadre = document.createElement ( 'div' );
	titreCadre.classList.add ( 'titre' );
	titreCadre.innerText = semestre + '  (' + annee + ')';
	cadreImport.appendChild ( titreCadre );

	// Jury
	jury = document.createElement ( 'div' );
	jury.classList.add ( 'infos-import' );
	jury.innerText = 'Jury : ' + fichierJury.name;
	cadreImport.appendChild ( jury );

	// Moyenne
	moyenne = document.createElement ( 'div' );
	moyenne.classList.add( 'infos-import' );
	moyenne.innerText = 'Moyenne : ' + fichierMoyenne.name;
	cadreImport.appendChild ( moyenne );

	// Bouton supprimer
	btnSupprimer = document.createElement ( 'button' );
	btnSupprimer.classList.add ( 'btn-supprimer' );
	btnSupprimer.innerText = 'Supprimer';
	btnSupprimer.addEventListener('click', supprimerCadreImport);
	cadreImport.appendChild ( btnSupprimer );
}

//FIXME: Fichier resté importé ? (à voir avec input file)
function resetPopup ()
{
	document.getElementById('choix-semestre').value = "default";

	resetNomFichier(document.getElementById('svg-jury'));
	resetNomFichier(document.getElementById('svg-moyenne'));
}

function resetNomFichier(svg)
{
	svg.removeChild(svg.querySelector('#svg-design'));

	svg.innerHTML = svg.innerHTML + '<path id="svg-design" fill-rule="evenodd" clip-rule="evenodd" d="M89.375 34V11.5H80.375V13.75H87.125V31.75H66.875V13.75H73.625V11.5H64.625V34H89.375ZM75.875 19.375H71.375L77 26.125L82.625 19.375H78.125V7H75.875V19.375Z" fill="white"/>';
}

// Boutons supprimer
function supprimerCadreImport ( event )
{
	console.log ( event.target.parentNode );
	divEvent = event.target.parentNode;

	indiceASuppr = Array.from(divEvent.classList)[1].match(/\d+/g).map(Number);

	tabFichiers.delete('formData'+indiceASuppr);

	console.log(tabFichiers)
	
	event.target.parentNode.remove ( );
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

		remplacerFichier(svgJury, fichierJury)
	}
});

inputFileMoyenne    .addEventListener('change', function()
{
	fichierMoyenne = inputFileMoyenne.files[0];

	if (fichierMoyenne)
	{
		svgMoyenne = document.getElementById('svg-moyenne');

		remplacerFichier(svgMoyenne, fichierMoyenne)
	}
});

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

btnImporter.addEventListener ( 'click', envoyerDocuments );

// ENTREE COEFFICIENTS
const btnAjoutCoeff = document.querySelector('.btn-ajout-coeff');
const inputCoeff    = document.getElementById('entree-coeff');

var fichierCoeff = null;

btnAjoutCoeff.addEventListener('click', function()
{
	console.log('test');
	inputCoeff.click();
});

inputCoeff    .addEventListener('change', function()
{
	fichierCoeff = inputFileJury.files[0];

	if (fichierCoeff)
	{
		btnAjoutCoeff.innerText = fichierCoeff.name;
	}
});

function envoyerDocuments ( )
{
	// Fetch vers le ControleurVue pour envoyer le json des documents

	const chargement = document.querySelector('.chargement');
	chargement.style.display = 'flex';

	const conteneurImport = document.querySelector ( '.conteneur-import' );
	conteneurImport.style.display = 'none';

	tabFichiers.append('fichierCoeff', fichierCoeff);

	fetch ( '../../controleur/ControleurVue.inc.php',
	{
		method: 'POST',
		body: tabFichiers
	})
	.then ( reponse => reponse.json())
	.then (data => 
		{
			console.log('reponse : ');
			console.log(data);
			if (data.succes)
			{
				window.location.href = '../visualiser/visualiser.php';
			}
		} )
	.catch ( erreur => 
		{
			console.log ( erreur );
		})
}