/* Variables nécessaires au fetch */
var anneeSelectionnee;
var semestreSelectionne;

/* Lecture des années renseignées */
// En gros dans la liste Année y aura que les années remplies dans la bado
fetch ('../../controleur/ControleurVue.inc.php?anneesRenseignees=true')
	.then ( reponse => reponse.json ( ) )
	.then ( donnees => 
		{
			donnees.forEach ( function ( donnee )
			{
				creerOption ( donnee );
			} );
		})
	.catch ( erreur => console.error ( erreur ) )

/* Placement des années dans la sélection */
const choixAnnee = document.getElementById('choix-annee');
function creerOption ( annee )
{
	console.log(annee);
	option = document.createElement('option');
	option.value = annee;
	option.innerText = annee;

	choixAnnee.appendChild ( option );
}

/* Evenement en fonction de l'année sélectionnée */
choixAnnee.addEventListener('change', function()
{
	anneeSelectionnee = choixAnnee.value;
	fetchDonneeEtudiant()
})

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
		semestreSelectionne = parseInt(bouton.innerText.substring(1,2));

		fetchDonneeEtudiant()
	} )
} );


// TODO: Fetch selon le semestre sélectionné

function fetchDonneeEtudiant()
{
	
	console.log('semestre : ' + semestreSelectionne + ' annee : ' + anneeSelectionnee)
	if (!semestreSelectionne || !anneeSelectionnee)
	{
		console.log('un argument nest pas défini')
		return;
	}

	reinitialiserPage();
	
	fetch ( '../../controleur/ControleurVue.inc.php?numSemestre=' + semestreSelectionne + '&annee=' + anneeSelectionnee )
		.then ( reponse => reponse.json ( ) )
		.then ( donnees =>
		{
			try {
					genererEntete(Object.keys(donnees[0].cursus))
			}
			catch (error) {
				
			}
			
			donnees.forEach(function (etudiant) {
				ajouterEtudiantTableau(etudiant);
			});

		})
		.catch (erreur => console.error(erreur))
}

function reinitialiserPage()
{
	const tabNomPrenom              = document.querySelector ( '.tableau-nom-etd tbody' );
	tabNomPrenom.innerHTML = "";

	const tabResumeComptence   = document.querySelector ( '.tableau-note-etd tbody' ); //FIXME: vire pas les en tete
	tabResumeComptence.innerHTML = "";

}

function ajouterEtudiantTableau ( etudiant )
{
	/*+-----------------------------------+*/
	/*|      TABLEAU : NOM - PRENOM       |*/
	/*+-----------------------------------+*/
	
	const tabNomPrenom              = document.querySelector ( '.tableau-nom-etd tbody' );
	const tabNomPrenomligneEtudiant = document.createElement ( 'tr' );

	tabNomPrenomligneEtudiant.classList.add ( 'cellule-cliquable-nom')
	tabNomPrenomligneEtudiant.addEventListener('click', function ( ) 
	{
		ouverturePopupEtudiant ( );
		majPopupEtudiant ( etudiant );
	} );

	tabNomPrenomligneEtudiant.id = `${etudiant.codeNIP}`;
	tabNomPrenomligneEtudiant.innerHTML = `
		<td>${etudiant.nom   }</td>
		<td>${etudiant.prenom}</td>`;

	tabNomPrenom.appendChild ( tabNomPrenomligneEtudiant );
	
	/*+-----------------------------------+*/
	/*|    TABLEAU : RESUMÉ COMPETENCE    |*/
	/*+-----------------------------------+*/

	// TODO: Mettre la couleur sur les en-tete

	const tabResumeComptence   = document.querySelector ( '.tableau-note-etd tbody' );
	const tabResumeligneResume = document.createElement ( 'tr' );

	var htmlResume = "";
	var nbUEs = 0;
	
	const moyCompetence  = new Map   ( );
	const moysCompetence = new Array ( );
	const competences    = etudiant.cursus;

	for ( const competence in competences )
	{
		const ensMatiere = competences[competence].matieres;

		var admission = competences[competence].admission

		if ( admission === 'ADM' || admission === 'CMP' || admission === 'ADSUP')
			nbUEs += 1;

		ensMatiere.forEach ( matiere =>
		{
			moyCompetence.set ( matiere.libelle, [ matiere.moyenne, matiere.coef ] );
		} );

		var moyenneEnCours = calculerMoyenneCompetence ( moyCompetence );
		 
		moysCompetence.push ( moyenneEnCours );

		htmlResume += `<td>${moyenneEnCours}</td>`;
	}

	const somme           = moysCompetence.reduce ( ( a, b ) => a + parseFloat ( b ), 0 );
	const moyenneSemestre = ( somme / moysCompetence.length ).toFixed ( 2 );


	tabResumeligneResume.innerHTML = `<td>${moyenneSemestre}</td>${htmlResume}<td>${nbUEs}/${Object.keys ( competences ).length}</td>`;
	
	tabResumeComptence.appendChild ( tabResumeligneResume );
};

function calculerMoyenneCompetence ( donnee )
{
	let totalNote  = 0;
	let totalCoeff = 1;

	donnee.forEach ( ( matière ) =>
	{
		const [note, coeff] = matière;
		totalNote  += note * coeff;
		totalCoeff += coeff;
	} );

	return (totalNote / totalCoeff).toFixed(2);
}

function genererEntete ( tabEntete )
{
	//FIXME: problème quand y'a aucune donnée dans la base de donnée
	
	const tabResumeComptence2 = document.querySelector ( '.tableau-note-etd thead' );
	var enteteTab             = document.createElement ( 'tr' );

	enteteTab.innerHTML = `<th>Moyenne Semestre</th>`;

	tabEntete.forEach ( function ( entete )
	{
		enteteTab.innerHTML += `<th>${entete}</th>`;
	} );

	enteteTab.innerHTML += `<th>UEs</th>`;

	tabResumeComptence2.appendChild ( enteteTab );
}
