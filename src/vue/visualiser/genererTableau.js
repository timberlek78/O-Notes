fetchDonneeEtudiant(1);

function fetchDonneeEtudiant(numSemestre)
{
    console.log('../../controleur/ControleurVue.inc.php?numSemestre=' + numSemestre);
    fetch('../../controleur/ControleurVue.inc.php?numSemestre=' + numSemestre)
        .then (reponse => reponse.json())
        .then (donnees =>
            {
                console.log(donnees);
            })
        .catch (erreur => console.error('Erreur lors du fetch'))
}


function ajouterEtudiantTableau ( etudiant )
{
	/*+-----------------------------------+*/
	/*|      TABLEAU : NOM - PRENOM       |*/
	/*+-----------------------------------+*/
	
	const tabNomPrenom              = document.querySelector ( '.tableau-nom-etd tbody' );
	const tabNomPrenomligneEtudiant = document.createElement ( 'tr' );

	tabNomPrenomligneEtudiant.id = `${etudiant.codeNIP}`;
	tabNomPrenomligneEtudiant.innerHTML = `
		<td>${etudiant.nom   }</td>
		<td>${etudiant.prenom}</td>`;

	tabNomPrenom.appendChild ( tabNomPrenomligneEtudiant );
	
	/*+-----------------------------------+*/
	/*|    TABLEAU : RESUMÉ COMPETENCE    |*/
	/*+-----------------------------------+*/

	//TODO: Prendre en compte les en-tête
	//TODO: Calculer les UEs validé

	const tabResumeComptence   = document.querySelector ( '.tableau-note-etd tbody' );
	const tabResumeligneResume = document.createElement ( 'tr' );

	const htmlResume = "";
	
	const moyCompetence  = new Map   ( );
	const moysCompetence = new Array ( );

	const competences = etudiant.cursus;
	Object.keys ( competences ).forEach ( competence =>
	{
		const ensMatiere = competence.matieres;

		ensMatiere.forEach ( matiere =>
		{
			moyCompetence.set ( matiere.libelle, [ matiere.moyenne, matiere.coeff ] );
		} );

		const moyenneEnCours = calculerMoyenneCompetence ( moyCompetence );

		moysCompetence.add ( moyenneEnCours );

		htmlResume += `<td>${moyenneEnCours}</td>`;
	} );

	const somme           = moysCompetence.reduce ( ( a, b ) => a + b, 0 );
	const moyenneSemestre = somme / tableau.length;

	tabResumeligneResume.innerHTML = 
	`<td>${moyenneSemestre}</td>
	<td>${htmlResume}</td>
	<td>X/X</td>`;

	tabResumeComptence.appendChild ( tabResumeligneResume );
};

function calculerMoyenneCompetence ( donnee )
{
	let totalNote  = 0;
	let totalCoeff = 0;

	donnee.forEach ( ( matière ) =>
	{
		const [note, coeff] = matière;
		totalNote  += note * coeff;
		totalCoeff += coeff;
	} );

	return totalNote / totalCoeff;
}
