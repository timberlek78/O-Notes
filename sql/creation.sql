CREATE SCHEMA IF NOT EXISTS onote;

-- Suppression des tables si elles existent déjà

DROP TABLE IF EXISTS est_noté;
DROP TABLE IF EXISTS Possede;
DROP TABLE IF EXISTS Cursus;
DROP TABLE IF EXISTS CompMat;
DROP TABLE IF EXISTS EtudSem;
DROP TABLE IF EXISTS Avis_de_poursuite_d_étude;
DROP TABLE IF EXISTS Etudiant;
DROP TABLE IF EXISTS FPE;
DROP TABLE IF EXISTS Illustration;
DROP TABLE IF EXISTS Utilisateur_;
DROP TABLE IF EXISTS Matiere;
DROP TABLE IF EXISTS Competence;
DROP TABLE IF EXISTS Semestre;
DROP TABLE IF EXISTS Etude;

-- Création des tables

CREATE TABLE Etude (
    idEtude INT PRIMARY KEY,
    specialite VARCHAR(20),
    typeBac VARCHAR(20)
);

CREATE TABLE Semestre (
    numSemestre INT PRIMARY KEY
);

CREATE TABLE Competence (
    libelle VARCHAR(10),
    annee   INT,
    PRIMARY KEY (libelle, annee)
);

CREATE TABLE Matiere (
    libelle   VARCHAR(10),
    alternant BOOLEAN,
    PRIMARY KEY (libelle)
);

CREATE TABLE Utilisateur_ (
    idUser VARCHAR(15) PRIMARY KEY,
    mDp    VARCHAR(10)
);

CREATE TABLE Illustration (
    idIllustration INT PRIMARY KEY,
    img TEXT,
    alternative VARCHAR(50)
);

CREATE TABLE FPE (
    idFPE VARCHAR(50) PRIMARY KEY,
    nomDirecteur VARCHAR(15),
    anneePromo DATE
);

CREATE TABLE Etudiant (
    codeNIP INT PRIMARY KEY,
    nom VARCHAR(20),
    prenom VARCHAR(10),
    parcours VARCHAR(50),
    promotion VARCHAR(50),
    idIllustration INT,
    idEtude INT,
    FOREIGN KEY (idIllustration) REFERENCES Illustration(idIllustration),
    FOREIGN KEY (idEtude) REFERENCES Etude(idEtude)
);

CREATE TABLE Avis_de_poursuite_d_étude (
    idAvis VARCHAR(10) PRIMARY KEY,
    AvisMaster VARCHAR(20),
    AvisEcoleInge VARCHAR(50),
    commentaire TEXT,
    codeNIP INT,
    FOREIGN KEY (codeNIP) REFERENCES Etudiant(codeNIP)
);

CREATE TABLE EtudSem (
    codeNIP INT,
    numSemestre INT,
    rang INT,
    nbAbs INT,
    passage VARCHAR(2),
    PRIMARY KEY (codeNIP, numSemestre),
    FOREIGN KEY (codeNIP) REFERENCES Etudiant(codeNIP),
    FOREIGN KEY (numSemestre) REFERENCES Semestre(numSemestre)
);

CREATE TABLE CompMat (
    libelle VARCHAR(10),
    annee INT,
    libelle_1 VARCHAR(10),
    coeff INT,
    PRIMARY KEY ((libelle, annee), libelle_1),
    FOREIGN KEY (libelle, annee) REFERENCES Competence(libelle, annee),
    FOREIGN KEY (libelle_1) REFERENCES Matiere(libelle)
);

CREATE TABLE Cursus (
    codeNIP INT,
    numSemestre INT,
    libelle VARCHAR(10),
    annee INT,
    admission VARCHAR(5),
    PRIMARY KEY (codeNIP, numSemestre, libelle, annee),
    FOREIGN KEY (codeNIP) REFERENCES Etudiant(codeNIP),
    FOREIGN KEY (numSemestre) REFERENCES Semestre(numSemestre),
    FOREIGN KEY (libelle, annee) REFERENCES Competence(libelle, annee)
);

CREATE TABLE Possede (
    idIllustration INT,
    idFPE VARCHAR(50),
    PRIMARY KEY (idIllustration, idFPE),
    FOREIGN KEY (idIllustration) REFERENCES Illustration(idIllustration),
    FOREIGN KEY (idFPE) REFERENCES FPE(idFPE)
);

CREATE TABLE est_noté (
    codeNIP INT,
    libelle VARCHAR(10),
    moyenne DECIMAL(15,2),
    PRIMARY KEY (codeNIP, libelle),
    FOREIGN KEY (codeNIP) REFERENCES Etudiant(codeNIP),
    FOREIGN KEY (libelle) REFERENCES Matiere(libelle)
);
