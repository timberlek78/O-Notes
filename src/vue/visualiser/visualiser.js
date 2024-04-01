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
const lstCellulesCliquablesNom = document.querySelectorAll ( '.cellule-cliquable-nom' );
const popupEtudiant            = document.querySelector    ( '.popup-etudiant'        );
const tabEtudiant              = document.querySelector    ( '.conteneur-tableau-etd' );
const boutonFermer             = document.querySelector    ( '.fermeture'             );

lstCellulesCliquablesNom.forEach( function( cellule )
{
	cellule.addEventListener ( 'click', ouverturePopupEtudiant );
} );

boutonFermer.addEventListener ( 'click', fermeturePopupEtudiant )

function ouverturePopupEtudiant ( )
{
	popupEtudiant.classList.add ( 'ouvert' );
	tabEtudiant  .classList.add ( 'cache'  );

	// Récupération du nom pour le placer dans le popup
	const popupPrenom = document.getElementById ( 'popup-prenom' );
	const popupNom    = document.getElementById ( 'popup-nom'    );

	const parties = this.textContent.split('\n\t\t\t\t\t\t\t');

	const nomsPrenoms = parties.map(partie => partie.trim());

	popupPrenom.innerText = nomsPrenoms[2];
	popupNom   .innerText = nomsPrenoms[1];

	console.log('Prenom : ' + prenom + ' Nom : ' + nom)
	
}

function fermeturePopupEtudiant ( )
{
	popupEtudiant.classList.remove ( 'ouvert' );
	tabEtudiant  .classList.remove ( 'cache'  );
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
/*   BAR DE NAVIGATION DES SEMSETRES   */
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