CREATE TABLE Etudiant (
    etudID INT PRIMARY KEY,
    codeNIP INT,
    Nom VARCHAR(20),
    Prenom VARCHAR(10),
    civilite VARCHAR(50),
    Parcours VARCHAR(50)
);

CREATE TABLE Etude (
    idEtude INT PRIMARY KEY,
    specialite VARCHAR(20),
    typeBac VARCHAR(20),
    etudID INT,
    FOREIGN KEY (etudID) REFERENCES Etudiant(etudID)
);

CREATE TABLE Semestre (
    numSemestre INT PRIMARY KEY
);

CREATE TABLE Competence (
    numCompt INT PRIMARY KEY
);

CREATE TABLE Matiere (
    numMatiere INT PRIMARY KEY,
    moyenne DECIMAL(2,2),
    coeff INT
);

CREATE TABLE ETUD_SEM (
    etudID INT,
    numSemestre INT,
    grpTD VARCHAR(1),
    grpTP VARCHAR(2),
    passage VARCHAR(2),
    Rang INT,
    nbAbs INT,
    PRIMARY KEY (etudID, numSemestre),
    FOREIGN KEY (etudID) REFERENCES Etudiant(etudID),
    FOREIGN KEY (numSemestre) REFERENCES Semestre(numSemestre)
);

CREATE TABLE Comp_mat (
    numCompt INT,
    numMatiere INT,
    PRIMARY KEY (numCompt, numMatiere),
    FOREIGN KEY (numCompt) REFERENCES Competence(numCompt),
    FOREIGN KEY (numMatiere) REFERENCES Matiere(numMatiere)
);

CREATE TABLE Cursus (
    etudID INT,
    numSemestre INT,
    numCompt INT,
    admission VARCHAR(5),
    PRIMARY KEY (etudID, numSemestre, numCompt),
    FOREIGN KEY (etudID, numSemestre) REFERENCES ETUD_SEM(etudID, numSemestre),
    FOREIGN KEY (numCompt) REFERENCES Competence(numCompt)
);
