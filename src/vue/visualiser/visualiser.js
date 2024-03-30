/*                        */
/*   SCROLL SYNCHRONISE   */
/*                        */
const table1 = document.querySelector('.liste-etd');
const table2 = document.querySelector('.liste-note');

/* Permet de faire défiler les deux tableaux en même temps */
table1.addEventListener('scroll', function() {
	table2.scrollTop = table1.scrollTop;
});

table2.addEventListener('scroll', function() {
	table1.scrollTop = table2.scrollTop;
});


/* Fonction qui permet d'adapter la hauteur de l'entête du tableau selon la hauteur maximal entre les deux tableaux */
function adaptationHauteur () 
{

const hauteurTableauNom  = document.querySelector('.tableau-nom-etd thead');
const hauteurTableauNote = document.querySelector('.tableau-note-etd thead');

const hauteurMax = Math.max(hauteurTableauNom.clientHeight, hauteurTableauNote.clientHeight);

hauteurTableauNom.style.height = hauteurMax + 'px';
hauteurTableauNote.style.height = hauteurMax + 'px';
}

/* Déclanche la méthode lors du chargement de la page et du resize de la page */
window.addEventListener ( 'resize', adaptationHauteur );
window.addEventListener ( 'load'  , adaptationHauteur );

/*                                          */
/*   FONCTIONNEMENT DE LA POP-UP ETUDIANT   */
/*                                          */
const lstCellulesCliquablesNom = document.querySelectorAll ( '.cellule-cliquable-nom' )
const popupEtudiant            = document.querySelector    ( '.popup-etudiant'        );
const tabEtudiant              = document.querySelector    ( '.conteneur-tableau-etd' );

lstCellulesCliquablesNom.forEach(function(cellule)
{
	cellule.addEventListener('click', ouverturePopupEtudiant);
})

console.log(lstCellulesCliquablesNom);
function ouverturePopupEtudiant()
{
	popupEtudiant.classList.add('ouvert');
	tabEtudiant  .classList.add('cache');
	
}

function fermeturePopupEtudiant()
{
	popupEtudiant.classList.remove('ouvert');
	tabEtudiant  .classList.remove('cache');
}