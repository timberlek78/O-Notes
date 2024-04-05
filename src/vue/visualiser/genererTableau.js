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
const choixAnnee = document.getElementById ( 'choix-annee' );
function creerOption ( annee )
{
	option = document.createElement ( 'option' );

	option.value     = annee;
	option.innerText = annee;

	choixAnnee.appendChild ( option );
}

/* Evenement en fonction de l'année sélectionnée */
choixAnnee.addEventListener ( 'change', function ( )
{
	anneeSelectionnee = choixAnnee.value;
	fetchDonneeEtudiant ( );
} );

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
		semestreSelectionne = parseInt ( bouton.innerText.substring ( 1,2 ) );

		fetchDonneeEtudiant ( );
	} )
} );


// Test déclaration des valeurs à l'extérieur pour y avoir accès
var ensDetailCompetence = new Map ( );

function fetchDonneeEtudiant()
{
	if ( ! semestreSelectionne || ! anneeSelectionnee )
	{
		console.log('un argument nest pas défini')
		return;
	}

	reinitialiserPage ( );
	
	fetch ( '../../controleur/ControleurVue.inc.php?numSemestre=' + semestreSelectionne + '&annee=' + anneeSelectionnee )
		.then ( reponse => reponse.json ( ) )
		.then ( donnees =>
		{
			try
			{
				genererEntete ( Object.keys ( donnees[0].cursus ) );

				ensDetailCompetence.forEach ( (value, key) =>
				{
					genererEntetePopup ( key, donnees[0].cursus[key].matieres );
				} );
			}
			catch ( error )
			{
				console.log ( error );
			}
			
			donnees.forEach ( function ( etudiant )
			{
				ajouterEtudiantTableau ( etudiant );
			} );

			ajoutListener ( );
		} )
		.catch ( erreur => console.error ( erreur ) )
}

function reinitialiserPage ( )
{
	const tabNomPrenom             = document.querySelector ( '.tableau-nom-etd tbody'  );
	const tabResumeComptenceEnTete = document.querySelector ( '.tableau-note-etd thead' );
	const tabResumeComptence       = document.querySelector ( '.tableau-note-etd tbody' );
	
	tabNomPrenom            .innerHTML = "";
	tabResumeComptence      .innerHTML = "";
	tabResumeComptenceEnTete.innerHTML = "";

	ensDetailCompetence = new Map ( );
}

function ajouterEtudiantTableau ( etudiant )
{
	/*+-----------------------------------+*/
	/*|      TABLEAU : NOM - PRENOM       |*/
	/*+-----------------------------------+*/
	
	const tabNomPrenom              = document.querySelector ( '.tableau-nom-etd tbody' );
	const tabNomPrenomligneEtudiant = document.createElement ( 'tr' );

	tabNomPrenomligneEtudiant.classList.add ( 'cellule-cliquable-nom')
	tabNomPrenomligneEtudiant.addEventListener ( 'click', function ( )
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

	const tabResumeComptence   = document.querySelector ( '.tableau-note-etd tbody' );
	const tabResumeligneResume = document.createElement ( 'tr' );

	var htmlResume = "";
	var nbUEs      = 0;
	
	const moysCompetence = new Array ( );
	const competences    = etudiant.cursus;

	for ( const competence in competences )
	{
		var moyCompetence       = new Map   ( );
		var ensembleNoteMatiere = new Array ( );
		var ensMatiere = competences[competence].matieres;
		
		// Calcul les ues validés par l'étudiant
		var admission  = competences[competence].admission

		if ( admission === 'ADM' || admission === 'CMP' || admission === 'ADSUP' )
			nbUEs += 1;

		// Ajoute le Bonus à la ligne de l'étudiant
		ensembleNoteMatiere.push ( `<td> ${ensMatiere[0].moyenne} </td>` );

		let counter = 0;
		ensMatiere.forEach ( matiere =>
		{
			if ( counter !== 0 )
			{
				moyCompetence.set ( matiere.libelle, [ matiere.moyenne, matiere.coef ]);
				ensembleNoteMatiere.push ( `<td> ${matiere.moyenne} </td>` );
			}
			counter++;
		} );

		var moyenneEnCours = ( parseFloat ( calculerMoyenneCompetence ( moyCompetence ) ) + ensMatiere[0].moyenne ).toFixed ( 2 ) ;

		// Met la moyenne de la compétence au début du tableau
		ensembleNoteMatiere.unshift ( `<td> ${moyenneEnCours} </td>` );

		// Ajoute les notes de l'étudiant dans le détail des compétences
		ensDetailCompetence.get ( competence ).push ( ensembleNoteMatiere );
		
		moysCompetence.push ( moyenneEnCours );

		htmlResume += `<td>${moyenneEnCours}</td>`;
	}

	// Calcul de la moyenne générale du semestre
	var somme           = moysCompetence.reduce ( ( a, b ) => a + parseFloat ( b ), 0 );
	var moyenneSemestre = ( somme / moysCompetence.length ).toFixed ( 2 );

	// Information sur l'étudiant
	tabResumeligneResume.innerHTML = `<td>${moyenneSemestre}</td>${htmlResume}<td>${nbUEs}/${Object.keys ( competences ).length}</td>`;
	
	// Ajoute la ligne de l'étudiant
	tabResumeComptence.appendChild ( tabResumeligneResume );
};

function calculerMoyenneCompetence ( donnee )
{
	let totalNote  = 0;
	let totalCoeff = 0;

	donnee.forEach ( ( matière ) =>
	{
		let [note, coeff] = matière;

		totalNote  += note * coeff;
		totalCoeff += coeff;
	} );

	return ( totalNote / totalCoeff ).toFixed ( 2 );
}

function genererEntete ( tabEntete )
{
	const tabResumeComptence2 = document.querySelector ( '.tableau-note-etd thead' );
	var enteteTab             = document.createElement ( 'tr' );

	enteteTab.innerHTML = `<th>Moyenne Semestre</th>`;

	tabEntete.forEach ( function ( entete )
	{
		enteteTab.innerHTML += `<th ${'class=bin id=bin' + entete.charAt ( entete.length - 1 ) } >${entete}</th>`;
		ensDetailCompetence.set ( entete, new Array ( ) );
	} );

	enteteTab.innerHTML += `<th>UEs</th>`;

	tabResumeComptence2.appendChild ( enteteTab );
}

function genererEntetePopup ( competence, tabEntete )
{
	var enteteTab = document.createElement ( 'tr' );

	enteteTab.innerHTML += `<th>Moyenne compétence</th>`

	tabEntete.forEach ( function ( entete )
	{
		enteteTab.innerHTML += `<th>${entete.libelle}</th>`;
	} );

	ensDetailCompetence.get ( competence ).push ( enteteTab );
}