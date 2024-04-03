/*                        */
/*   SCROLL SYNCHRONISE   */
/*                        */
const table1 = document.querySelector ( '.liste-etd'  );
const table2 = document.querySelector ( '.liste-note' );

/* Permet de faire défiler les deux tableaux en même temps */
table1.addEventListener ( 'scroll', function ( )
{
	table2.scrollTop = table1.scrollTop;
} );

table2.addEventListener ( 'scroll', function ( )
{
	table1.scrollTop = table2.scrollTop;
} );

/* Fonction qui permet d'adapter la hauteur de l'entête du tableau selon la hauteur maximal entre les deux tableaux */
function adaptationHauteur ( )
{
	const hauteurTableaux    = document.querySelectorAll ( ' thead'          );
	const hauteurCroixCompet = document.querySelectorAll ( '.fermetureCompt' );

	// Permet de définir la hateur max parmi tous les tableaux de la page
	const hauteurMax = Math.max ( ...Array.from ( hauteurTableaux ).map ( table => table.clientHeight ) );

	// Défini la taille aux en-tete du tableau
	hauteurTableaux.forEach ( table =>
	{
		table.style.height = hauteurMax + 'px';
	} );

	// Defini la taille aux croix pour fermer les popup du détail des compétences
	hauteurCroixCompet.forEach ( croix =>
	{
		croix.style.height = hauteurMax + 'px';
	} );
}

/* Déclanche la méthode lors du chargement de la page et du resize de la page */
window.addEventListener ( 'resize', adaptationHauteur );
window.addEventListener ( 'load'  , adaptationHauteur );

/*                                          */
/*   FONCTIONNEMENT DE LA POP-UP ETUDIANT   */
/*                                          */
const popupEtudiant            = document.querySelector    ( '.popup-etudiant'            );
const tabEtudiant              = document.querySelector    ( '.conteneur-tableau-etd'     );

function ouverturePopupEtudiant ( )
{
	const ligneNote                = document.querySelectorAll ( '.tableau-note-etd tr'       );
	const ligneCompetence          = document.querySelectorAll ( '.tableau-competence-etd tr' );
	const boutonFermer             = document.querySelector    ( '.fermeture'                 );
		
	boutonFermer.addEventListener ( 'click', fermeturePopupEtudiant )
	const ligne  = event.target.parentNode;

	const indice = Array.from ( ligne.parentNode.children ).indexOf ( ligne );

	// Ajoute la surbrillance sur la ligne
	for ( let i = 1; i < ligneCompetence.length; i++ )
	{
		if ( i % ligneNote.length === ( indice + 1 ) )
		{
			ligneNote      [i%ligneNote.length].classList.add ( 'ligneValeur' );
			ligneCompetence[i                 ].classList.add ( 'ligneValeur' );
			
		}
		else if ( i % ligneNote.length !== 0 )
		{
			ligneCompetence[i                 ].classList.add ( 'ligneAutre' );
			ligneNote      [i%ligneNote.length].classList.add ( 'ligneAutre' );
		}
	}

	popupEtudiant.classList.add ( 'ouvert' );
	tabEtudiant  .classList.add ( 'cache'  );
}


function majPopupEtudiant ( etudiant )
{
	//FIXME: potentiellement un erreur si des informations sont vides
	const conteneurCadreInfos = document           .querySelector    ( '.conteneur-cadre-infos' );
	const nomPrenom           = document           .querySelector    ( '.conteneur-information' );
	const cadreInfos          = conteneurCadreInfos.querySelectorAll ( '.cadre-info'            );

	console.log ( nomPrenom.children[0] )

	nomPrenom.children[0].innerText = etudiant.prenom;
	nomPrenom.children[1].innerText = etudiant.nom;
	
	cadreInfos[0].children[1].innerText = etudiant.codeNIP;
	cadreInfos[1].children[1].innerText = etudiant.parcours;
	cadreInfos[2].children[1].innerText = etudiant.promotion;
	cadreInfos[3].children[1].innerText = etudiant.typeBac;
	cadreInfos[4].children[1].innerText = etudiant.specialite;
	cadreInfos[5].children[1].innerText = etudiant.etudsem.rang;
	cadreInfos[6].children[1].innerText = etudiant.etudsem.nbAbs;
}

function fermeturePopupEtudiant ( )
{
	const ligneNote                = document.querySelectorAll ( '.tableau-note-etd tr'       );
	const ligneCompetence          = document.querySelectorAll ( '.tableau-competence-etd tr' );
	popupEtudiant.classList.remove ( 'ouvert' );
	tabEtudiant  .classList.remove ( 'cache'  );

	// Retire la surbrillance sur la ligne
	for ( let i = 1; i < ligneCompetence.length; i++ )
	{
		ligneCompetence[i                 ].classList.remove ( 'ligneAutre'  );
		ligneCompetence[i                 ].classList.remove ( 'ligneValeur' );
		ligneNote      [i%ligneNote.length].classList.remove ( 'ligneAutre'  );
		ligneNote      [i%ligneNote.length].classList.remove ( 'ligneValeur' );
	}
}

/*                                                  */
/*   FONCTIONNEMENT DE LA POP-UP EDITION ETUDIANT   */
/*                                                  */
const popupEditionEtudiant = document.getElementById ( 'popup-edition-etudiant'  );
const btnEdition           = document.querySelector  ( '.edition'                );
const btnAnnuler           = document.querySelector  ( '.btn-annuler'            );
const btnValider           = document.querySelector  ( '.btn-valider'            );  //TODO: validation

btnEdition.addEventListener ( 'click', ouverturePopupEditionEtudiant );
btnAnnuler.addEventListener ( 'click', fermeturePopupEditionEtudiant );

function ouverturePopupEditionEtudiant ( )
{
	popupEditionEtudiant.classList.add ('ouvert');
}

function fermeturePopupEditionEtudiant ( )
{
	popupEditionEtudiant.classList.remove ( 'ouvert' );
}

/*                                     */
/*   BAR DE NAVIGATION DES SEMESTRES   */
/*                                     */

const ensBoutonsSemestre = document.querySelectorAll ( '.semestre' );

ensBoutonsSemestre.forEach ( function ( bouton )
{
	bouton.addEventListener ( 'click', function ( event )
	{
		ensBoutonsSemestre.forEach ( function ( bouton )
		{
			bouton.classList.remove ( 'btn-clique' );
		} )
		
		bouton.classList.add ( 'btn-clique' );
	} )
} );