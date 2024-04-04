CREATE SCHEMA IF NOT EXISTS onote;

-- Suppression des tables si elles existent deja

DROP TABLE IF EXISTS onote.EstNote CASCADE;
DROP TABLE IF EXISTS onote.Possede CASCADE;
DROP TABLE IF EXISTS onote.Cursus CASCADE;
DROP TABLE IF EXISTS onote.CompetenceMatiere CASCADE;
DROP TABLE IF EXISTS onote.EtudiantSemestre CASCADE;
DROP TABLE IF EXISTS onote.FPE CASCADE;
DROP TABLE IF EXISTS onote.Etudiant CASCADE;
DROP TABLE IF EXISTS onote.ConfigFPE CASCADE;
DROP TABLE IF EXISTS onote.Illustration CASCADE;
DROP TABLE IF EXISTS onote.Utilisateur CASCADE;
DROP TABLE IF EXISTS onote.Matiere CASCADE;
DROP TABLE IF EXISTS onote.Competence CASCADE;
DROP TABLE IF EXISTS onote.Semestre CASCADE;
DROP TABLE IF EXISTS onote.Etude    CASCADE;

-- CrÃ©ation des tables

CREATE TABLE onote.Etude (
	specialite VARCHAR( 20 ),
	typeBac VARCHAR( 20 ),
	PRIMARY KEY ( specialite, typeBac )
);

CREATE TABLE onote.Semestre (
	numSemestre INT PRIMARY KEY
);

CREATE TABLE onote.Competence (
	idCompetence VARCHAR( 10 ),
	annee        VARCHAR( 9  ),
	PRIMARY KEY( idCompetence, annee )
);

CREATE TABLE onote.Matiere (
	idMatiere VARCHAR( 20 ),
	alternant BOOLEAN,
	PRIMARY KEY ( idMatiere )
);

CREATE TABLE onote.Utilisateur (
	idUtilisateur VARCHAR( 15 ) PRIMARY KEY,
	mdp VARCHAR( 10 )
);

CREATE TABLE onote.Illustration (
	idIllustration INT PRIMARY KEY,
	img TEXT,
	alternative VARCHAR( 50 )
);

CREATE TABLE onote.ConfigFPE (
	idConfigFPE VARCHAR( 50 ) PRIMARY KEY,
	nomDirecteur VARCHAR( 15 ),
	anneePromo VARCHAR ( 9 )
);

CREATE TABLE onote.Etudiant (
	codeNIP INT PRIMARY KEY,
	nom VARCHAR( 20 ),
	prenom VARCHAR( 10 ),
	parcours VARCHAR( 50 ),
	promotion VARCHAR( 50 ),
	specialite VARCHAR( 20 ),
	typeBac VARCHAR( 20 ),
	FOREIGN KEY ( specialite, typeBac ) REFERENCES onote.Etude( specialite, typeBac )
);

CREATE TABLE onote.FPE (
	idFPE VARCHAR( 10 ) PRIMARY KEY,
	AvisMaster VARCHAR( 20 ),
	AvisEcoleInge VARCHAR( 50 ),
	commentaire TEXT,
	codeNIP INT,
	FOREIGN KEY ( codeNIP ) REFERENCES onote.Etudiant( codeNIP )
);

CREATE TABLE onote.EtudiantSemestre (
	codeNIP INT,
	numSemestre INT,
	rang INT,
	nbAbs INT,
	passage VARCHAR( 5 ),
	PRIMARY KEY ( codeNIP, numSemestre ),
	FOREIGN KEY ( codeNIP ) REFERENCES onote.Etudiant( codeNIP ),
	FOREIGN KEY ( numSemestre ) REFERENCES onote.Semestre( numSemestre )
);

CREATE TABLE onote.CompetenceMatiere (
	idCompetence VARCHAR( 10 ),
	annee VARCHAR ( 9 ),
	idMatiere VARCHAR( 20 ),
	coeff INT,
	PRIMARY KEY ( idCompetence, annee , idMatiere ),
	FOREIGN KEY ( idCompetence, annee ) REFERENCES onote.Competence( idCompetence, annee ),
	FOREIGN KEY ( idMatiere ) REFERENCES onote.Matiere( idMatiere )
);

CREATE TABLE onote.Cursus (
	codeNIP INT,
	numSemestre INT,
	idCompetence VARCHAR( 10 ),
	annee VARCHAR ( 9 ),
	admission VARCHAR( 5 ) CHECK (admission IN ('ADM','CMP','AJ','ADSUP')),
	PRIMARY KEY ( codeNIP, numSemestre, idCompetence, annee ),
	FOREIGN KEY ( codeNIP ) REFERENCES onote.Etudiant( codeNIP ),
	FOREIGN KEY ( numSemestre ) REFERENCES onote.Semestre( numSemestre ),
	FOREIGN KEY ( idCompetence, annee ) REFERENCES onote.Competence( idCompetence, annee )
);

CREATE TABLE onote.Possede (
	idIllustration INT,
	idConfigFPE VARCHAR( 50 ),
	PRIMARY KEY ( idIllustration, idConfigFPE ),
	FOREIGN KEY ( idIllustration ) REFERENCES onote.Illustration( idIllustration ),
	FOREIGN KEY ( idConfigFPE ) REFERENCES onote.ConfigFPE( idConfigFPE )
);

CREATE TABLE onote.EstNote (
	codeNIP INT,
	idMatiere VARCHAR( 20 ),
	moyenne DECIMAL( 15, 2 ),
	PRIMARY KEY ( codeNIP, idMatiere ),
	FOREIGN KEY ( codeNIP ) REFERENCES onote.Etudiant( codeNIP ),
	FOREIGN KEY ( idMatiere ) REFERENCES onote.Matiere( idMatiere )
);