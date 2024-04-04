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

// Modication de la taille des en-tete
const observer = new MutationObserver ( adaptationHauteur );
observer.observe ( document.body, { attributes: true, childList: true, subtree: true } );

/*                                          */
/*   FONCTIONNEMENT DE LA POP-UP ETUDIANT   */
/*                                          */
const popupEtudiant            = document.querySelector ( '.popup-etudiant'            );
const tabEtudiant              = document.querySelector ( '.conteneur-tableau-etd'     );
var indiceLigneSelectionne = -1;

function ouverturePopupEtudiant ( )
{
	let lignesNote                = document.querySelectorAll ( '.tableau-note-etd tr'       );

	let boutonFermer             = document.querySelector    ( '.fermeture'                 );

	boutonFermer.addEventListener ( 'click', fermeturePopupEtudiant )
	var ligne  = event.target.parentNode;
	indiceLigneSelectionne = Array.from ( ligne.parentNode.children ).indexOf ( ligne ) + 1;

	surbrillance ( lignesNote )

	popupEtudiant.classList.add ( 'ouvert' );
	tabEtudiant  .classList.add ( 'cache'  );
}

function surbrillance ( tableau )
{
	if ( indiceLigneSelectionne === -1 )
	{
		for ( let i = 1; i < tableau.length; i++ )
		{
			tableau[i].classList.remove ( 'ligneAutre'  );
			tableau[i].classList.remove ( 'ligneValeur' );
		}
		return;
	}

	for ( let i = 1; i < tableau.length; i++ )
		if ( indiceLigneSelectionne !== 0 && indiceLigneSelectionne !== i )
			tableau[i].classList.add ( 'ligneAutre' );


		tableau[indiceLigneSelectionne].classList.add ( 'ligneValeur' );
}

function majPopupEtudiant ( etudiant )
{
	const conteneurCadreInfos = document           .querySelector    ( '.conteneur-cadre-infos' );
	const nomPrenom           = document           .querySelector    ( '.conteneur-information' );
	const cadreInfos          = conteneurCadreInfos.querySelectorAll ( '.cadre-info'            );

	nomPrenom.children[0].innerText = etudiant.prenom;
	nomPrenom.children[1].innerText = etudiant.nom;
	
	cadreInfos[0].children[1].innerText = etudiant.codeNIP;
	cadreInfos[1].children[1].innerText = etudiant.parcours;
	cadreInfos[2].children[1].innerText = etudiant.promotion;
	cadreInfos[3].children[1].innerText = etudiant.typeBac;
	cadreInfos[4].children[1].innerText = etudiant.specialite;
	cadreInfos[5].children[1].innerText = etudiant.etudsem.rang;
	cadreInfos[6].children[1].innerText = etudiant.etudsem.nbAbsence;
}

function fermeturePopupEtudiant ( )
{
	var tabNote       = document.querySelectorAll ( '.tableau-note-etd tr'       );
	var tabCompetence = document.querySelectorAll ( '.tableau-competence-etd tr' );
	popupEtudiant.classList.remove ( 'ouvert' );
	tabEtudiant  .classList.remove ( 'cache'  );

	indiceLigneSelectionne = -1;
	surbrillance ( tabNote  )

	if ( tabCompetence.length !== 0 )
	{
		surbrillance ( tabCompetence );
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