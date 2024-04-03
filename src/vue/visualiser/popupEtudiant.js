function ouverturePopupEtudiant ( )
{
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