/* Fonction qui permet de changer la couleur en cours lors de la navigation du site */
function changerCouleurTableau ( couleur )
{
	const root = document.documentElement;

	// Sépare en 3 valeurs la couleur qui arrive en rgb (r,g,b)
	const rgbValues = couleur.substring ( 4, couleur.length - 1 ).split ( ',' );

	const rouge = parseInt ( rgbValues[0] );
	const vert  = parseInt ( rgbValues[1] );
	const bleu  = parseInt ( rgbValues[2] );

	// Applique à la variable la couleur de la compétence avec ces variantes pour le fond des lignes du tableau
	root.style.setProperty ( '--selectionne-couleur', couleur                                 );
	root.style.setProperty ( '--selectionne-impair' , `rgba(${rouge}, ${vert}, ${bleu}, 0.05)`);
	root.style.setProperty ( '--selectionne-pair'   , `rgba(${rouge}, ${vert}, ${bleu}, 0.25)`);
}


function ajoutListener ( )
{
	// Sélectionne toutes les compétences
	const ensCompetence = document.querySelectorAll ( '.bin' );

	ensCompetence.forEach ( function ( competence )
	{
		competence.addEventListener ( 'click', function ( event )
		{
			// Défini la couleur de la compétence pour les deux tableaux
			const couleurFond = getComputedStyle ( event.target ).getPropertyValue ( 'background-color' );

			changerCouleurTableau ( couleurFond );

			// Récupère le popup et le tableau des notes globales
			const popupCompetence = document.querySelector ( '.bin' + competence.textContent.charAt ( competence.textContent.length - 1 ) );
			const tabNoteEtud     = document.querySelector ( '.tableau-note-etd ' );

			popupCompetence.classList.add ( 'ouvert' );
			tabNoteEtud    .classList.add ( 'fermer' );
		} );
	} );

	const boutonFermerCompetence = document.querySelectorAll ( '.fermetureCompt'       );
	const popupCompetence        = document.querySelectorAll ( '.popup-competence-etd' );
	const tabNoteEtud            = document.querySelector    ( '.tableau-note-etd '    );

	/* Fonction qui permet de fermer le popup de la compétence quand on appuie sur la croix */
	boutonFermerCompetence.forEach ( function ( bouton )
	{
		bouton.addEventListener ( 'click', function ( event )
		{
			popupCompetence.forEach ( function ( popup )
			{
				popup.classList.remove ( 'ouvert' );
			} );
			tabNoteEtud    .classList.remove ( 'fermer' );

			changerCouleurTableau ( 'rgb(150, 82, 122)' );
		} );
	} );

}