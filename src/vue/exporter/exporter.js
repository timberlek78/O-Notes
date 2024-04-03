choixAnnee = document.getElementById('choix-annee');
choixAnnee.addEventListener('change', function()
{
	fetchAnneeData(choixAnnee.value)
	reinitialiserPage();
})


fetchAnneeData(1);

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
	conteneurImageEtudiant.innerHTML = '<img class="photo-etudiant" alt="photo-etudiant" src="../../../res/image/image.png"></img>';
	
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
btnValider.onclick = fermerPopUp;

function fermerPopUp ( )
{
	popupExportation.classList.remove('ouvert');
}
