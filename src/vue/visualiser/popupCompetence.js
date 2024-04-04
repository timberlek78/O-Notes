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

var popupCompetence        = document.querySelector ( '.popup-competence-etd'       );
var popupCompetenceHeader  = document.querySelector ( '.popup-competence-etd thead' );
var popupCompetenceBody    = document.querySelector ( '.popup-competence-etd tbody' );
var tabNoteEtud            = document.querySelector ( '.tableau-note-etd '          );
var boutonFermerCompetence = document.querySelector ( '.fermetureCompt'             );

function ajoutListener ( )
{
	// Sélectionne toutes les compétences
	const ensCompetence = document.querySelectorAll ( '.bin' );

	ensCompetence.forEach ( function ( competence )
	{
		competence.addEventListener ( 'click', function ()
		{
			ouvrirPopupCompetence ( competence );
		} );
	} );

	boutonFermerCompetence.addEventListener ( 'click', fermerPopupCompetence );
}

function ouvrirPopupCompetence ( competence )
{
	// Défini la couleur de la compétence pour les deux tableaux
	const couleurFond = getComputedStyle(competence).getPropertyValue('background-color');

	changerCouleurTableau ( couleurFond );
	
	majPopupCompetence ( ensDetailCompetence.get ( competence.textContent ) );

	let lignesCompetence          = document.querySelectorAll ( '.tableau-competence-etd tr' );

	surbrillance ( lignesCompetence );

	popupCompetence.classList.add ( 'ouvert' );
	tabNoteEtud    .classList.add ( 'fermer' );
}

function majPopupCompetence ( tabInformationPopup )
{
	// Header
	popupCompetenceHeader.appendChild ( tabInformationPopup[0] );

	// Données
	for ( let i = 1; i < tabInformationPopup.length; i++ )
	{
		let ligneEtudiant = document.createElement ( 'tr' );

		for ( let j = 0; j < tabInformationPopup[i].length; j++ )
			ligneEtudiant.innerHTML += tabInformationPopup[i][j];

		popupCompetenceBody.appendChild ( ligneEtudiant );
	}
}

function fermerPopupCompetence ( )
{
	popupCompetenceHeader.innerHTML = "";
	popupCompetenceBody  .innerHTML = "";

	popupCompetence.classList.remove ( 'ouvert' );
	tabNoteEtud    .classList.remove ( 'fermer' );
	
	changerCouleurTableau ( 'rgb(150, 82, 122)' );
}