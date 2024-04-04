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


/*                        */
/*   ADAPTATION HAUTEUR   */
/*                        */

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