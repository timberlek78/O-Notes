CREATE SCHEMA IF NOT EXISTS onote;

DROP TABLE IF EXISTS onote.Semestre CASCADE;
CREATE TABLE onote.Semestre 
(
    numSemestre INT,
    PRIMARY KEY (numSemestre)
);

DROP TABLE IF EXISTS onote.Competence CASCADE;
CREATE TABLE onote.Competence 
(
    numCompt INT,
    libelle VARCHAR(20),
    PRIMARY KEY (numCompt)
);

DROP TABLE IF EXISTS onote.Matiere CASCADE;
CREATE TABLE onote.Matiere 
(
    numMatiere INT,
    moyenne DECIMAL(4, 2),
    coeff INT,
    alternant BOOLEAN,
    libelle VARCHAR(20),
    PRIMARY KEY (numMatiere)
);

DROP TABLE IF EXISTS onote.Utilisateur CASCADE;
CREATE TABLE onote.Utilisateur
(
    idUser VARCHAR(15),
    nom VARCHAR(20),
    mdp VARCHAR(20),
    PRIMARY KEY (idUser)
);

DROP TABLE IF EXISTS onote.Illustration CASCADE;
CREATE TABLE onote.Illustration
(
    idIllustration INT,
    img BYTEA,
    alternative VARCHAR(50),
    PRIMARY KEY (idIllustration)
);

DROP TABLE IF EXISTS onote.FPE CASCADE;
CREATE TABLE onote.FPE 
(
    idFPE INT,
    nomDirecteur VARCHAR(15),
    anneePromoFin INT,
    anneePromoDebut INT,
    PRIMARY KEY (idFPE)
);

DROP TABLE IF EXISTS onote.Etudiant CASCADE;
CREATE TABLE onote.Etudiant 
(
    idEtudiant INT,
    codeNIP INT,
    nom VARCHAR(20),
    prenom VARCHAR(10),
    parcours VARCHAR(50),
    promotion VARCHAR(50),
    idIllustration INT,
    PRIMARY KEY (idEtudiant),
    FOREIGN KEY (idIllustration) REFERENCES onote.Illustration (idIllustration) ON DELETE CASCADE
);

DROP TABLE IF EXISTS onote.Etude CASCADE;
CREATE TABLE onote.Etude 
(
    idEtude INT,
    specialite VARCHAR(20),
    typeBac VARCHAR(20),
    idEtudiant INT,
    PRIMARY KEY (idEtude),
    FOREIGN KEY (idEtudiant) REFERENCES onote.Etudiant (idEtudiant) ON DELETE CASCADE
);

DROP TABLE IF EXISTS onote.EtudiantSemestre CASCADE;
CREATE TABLE onote.EtudiantSemestre
(
    idEtudiant INT,
    numSemestre INT,
    passage VARCHAR(5) CHECK (passage  IN ('ADM','CMP','AJ','ADSUP')),
    rang INT,
    nbAbsences INT,
    PRIMARY KEY (idEtudiant, numSemestre),
    FOREIGN KEY (idEtudiant) REFERENCES onote.Etudiant (idEtudiant) ON DELETE CASCADE,
    FOREIGN KEY (numSemestre) REFERENCES onote.Semestre (numSemestre) ON DELETE CASCADE
);

DROP TABLE IF EXISTS onote.CompetenceMatiere CASCADE;
CREATE TABLE onote.CompetenceMatiere
(
    numCompt INT,
    numMatiere INT,
    PRIMARY KEY (numCompt, numMatiere),
    FOREIGN KEY (numCompt) REFERENCES onote.Competence (numCompt) ON DELETE CASCADE,
    FOREIGN KEY (numMatiere) REFERENCES onote.Matiere (numMatiere) ON DELETE CASCADE
);

DROP TABLE IF EXISTS onote.Cursus CASCADE;
CREATE TABLE onote.Cursus 
(
    idEtudiant INT,
    numSemestre INT,
    numCompt INT,
    admission VARCHAR(10) CHECK (admission IN ('ADM','PASD','RED','NAR','ABL')),
    PRIMARY KEY (idEtudiant, numSemestre, numCompt),
    FOREIGN KEY (idEtudiant) REFERENCES onote.Etudiant (idEtudiant) ON DELETE CASCADE,
    FOREIGN KEY (numSemestre) REFERENCES onote.Semestre (numSemestre) ON DELETE CASCADE,
    FOREIGN KEY (numCompt) REFERENCES onote.Competence (numCompt) ON DELETE CASCADE
);

DROP TABLE IF EXISTS onote.Possede CASCADE;
CREATE TABLE onote.Possede
(
    idIllustration INT,
    idFPE INT,
    PRIMARY KEY (idIllustration, idFPE),
    FOREIGN KEY (idIllustration) REFERENCES onote.Illustration (idIllustration) ON DELETE CASCADE,
    FOREIGN KEY (idFPE) REFERENCES onote.FPE (idFPE) ON DELETE CASCADE
);
