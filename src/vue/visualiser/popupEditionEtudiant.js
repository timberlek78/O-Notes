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