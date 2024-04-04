<?php
// Liste des fichiers à inclure
$classesDonnee =
[
	'Competence.inc.php',
	'CompetenceMatiere.inc.php',
	'ConfigFPE.inc.php',
	'Cursus.inc.php',
	'EstNote.inc.php',
	'Etude.inc.php',
	'Etudiant.inc.php',
	'EtudiantSemestre.inc.php',
	'FPE.inc.php',
	'Illustration.inc.php',
	'Matiere.inc.php',
	'ObjetDAO.inc.php',
	'Possede.inc.php',
	'Semestre.inc.php',
	'Utilisateur.inc.php',
];

// Chemin de base
$repertoire = __DIR__ . '/dao/';

// Inclusion des fichiers
foreach ( $classesDonnee as $classe )
{
	require_once $repertoire . $classe;
}
?>
