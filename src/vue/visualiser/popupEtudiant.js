/*                                          */
/*   FONCTIONNEMENT DE LA POP-UP ETUDIANT   */
/*                                          */
var popupEtudiant          = document.querySelector ( '.popup-etudiant'            );
var tabEtudiant            = document.querySelector ( '.conteneur-tableau-etd'     );

var indiceLigneSelectionne = -1;

function ouverturePopupEtudiant ( )
{
	let lignesNote   = document.querySelectorAll ( '.tableau-note-etd tr'       );
	let tabCompetence = document.querySelectorAll ( '.tableau-competence-etd tr' );

	let boutonFermer = document.querySelector    ( '.fermeture'                 );
	var ligne  = event.target.parentNode;

	boutonFermer.addEventListener ( 'click', fermeturePopupEtudiant );
	indiceLigneSelectionne = Array.from ( ligne.parentNode.children ).indexOf ( ligne ) + 1;

	if ( tabCompetence.length !== 0 )
		surbrillance ( tabCompetence );

	surbrillance ( lignesNote );

	popupEtudiant.classList.add ( 'ouvert' );
	tabEtudiant  .classList.add ( 'cache'  );
}

function surbrillance ( tableau )
{
	// Cas pour remettre le style par défault
	if ( indiceLigneSelectionne === -1 )
	{
		for ( let i = 1; i < tableau.length; i++ )
		{
			tableau[i].classList.remove ( 'ligneAutre'  );
			tableau[i].classList.remove ( 'ligneValeur' );
		}
		return;
	}

	// Ajout du blur à toutes les lignes non-sélectionné
	for ( let i = 1; i < tableau.length; i++ )
		if ( indiceLigneSelectionne !== 0 && indiceLigneSelectionne !== i )
			tableau[i].classList.add ( 'ligneAutre' );

	// Met du relief à la ligne
	tableau[indiceLigneSelectionne].classList.add ( 'ligneValeur' );
}

function majPopupEtudiant ( etudiant )
{
	var conteneurCadreInfos = document           .querySelector    ( '.conteneur-cadre-infos' );
	var nomPrenom           = document           .querySelector    ( '.conteneur-information' );
	var cadreInfos          = conteneurCadreInfos.querySelectorAll ( '.cadre-info'            );

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
	surbrillance ( tabNote )

	if ( tabCompetence.length !== 0 )
		surbrillance ( tabCompetence );
}