CREATE SCHEMA IF NOT EXISTS onote;

CREATE TABLE onote.Semestre 
(
	numSemestre INT,

	PRIMARY KEY ( numSemestre )
);

CREATE TABLE onote.Competence 
(
	numCompt INT          ,
	libelle  VARCHAR ( 20 ),

	PRIMARY KEY ( numCompt )
);

CREATE TABLE onote.Matiere 
(
	numMatiere INT             ,
	moyenne    DECIMAL ( 2, 2 ),
	coeff      INT             ,
	alternant  BOOLEAN         ,
	libelle    VARCHAR ( 20 )  ,

	PRIMARY KEY ( numMatiere )
);

CREATE TABLE onote.Utilisateur
(
	idUser VARCHAR ( 15 ),
	nom    VARCHAR ( 20 ),
	mdp    VARCHAR ( 20 ),

	PRIMARY KEY ( idUser )
);

CREATE TABLE onote.Illustration
(
	idIllustration INT           ,
	img            BYTEA         ,
	alternative    VARCHAR ( 50 ),

	PRIMARY KEY ( idIllustration )
);

CREATE TABLE onote.FPE 
(
	idFPE        INT           ,
	nomDirecteur VARCHAR ( 15 ),
	anneePromo   DATE          ,

	PRIMARY KEY ( idFPE )
);

CREATE TABLE onote.Etudiant 
(
	idEtudiant     INT           ,
	codeNIP        INT           ,
	nom            VARCHAR ( 20 ),
	prenom         VARCHAR ( 10 ),
	parcours       VARCHAR ( 50 ),
	promotion      VARCHAR ( 50 ),
	idIllustration INT           ,

	PRIMARY KEY ( idEtudiant     ),
	FOREIGN KEY ( idIllustration ) REFERENCES onote.Illustration ( idIllustration )
);

CREATE TABLE onote.Etude 
(
	idEtude    INT           ,
	specialite VARCHAR ( 20 ),
	typeBac    VARCHAR ( 20 ),
	idEtudiant INT           ,

	PRIMARY KEY ( idEtude    ),
	FOREIGN KEY ( idEtudiant ) REFERENCES onote.Etudiant ( idEtudiant )
);

CREATE TABLE onote.EtudiantSemestre
(
	idEtudiant  INT          ,
	numSemestre INT          ,
	passage     VARCHAR ( 2 ),
	rang        INT          ,
	nbAbsences  INT          ,

	PRIMARY KEY ( idEtudiant, numSemestre ),
	FOREIGN KEY ( idEtudiant              ) REFERENCES onote.Etudiant ( idEtudiant  ),
	FOREIGN KEY ( numSemestre             ) REFERENCES onote.Semestre ( numSemestre )
);

CREATE TABLE onote.CompetenceMatiere
(
	numCompt   INT,
	numMatiere INT,

	PRIMARY KEY ( numCompt, numMatiere ),
	FOREIGN KEY ( numCompt             ) REFERENCES onote.Competence ( numCompt   ),
	FOREIGN KEY ( numMatiere           ) REFERENCES onote.Matiere    ( numMatiere )
);

CREATE TABLE onote.Cursus 
(
	idEtudiant  INT          ,
	numSemestre INT          ,
	numCompt    INT          ,
	admission   VARCHAR ( 5 ),

	PRIMARY KEY ( idEtudiant, numSemestre, numCompt ),
	FOREIGN KEY ( idEtudiant                        ) REFERENCES onote.Etudiant   ( idEtudiant  ),
	FOREIGN KEY ( numSemestre                       ) REFERENCES onote.Semestre   ( numSemestre ),
	FOREIGN KEY ( numCompt                          ) REFERENCES onote.Competence ( numCompt    )
);

CREATE TABLE onote.Possede
(
	idIllustration INT,
	idFPE          INT,

	PRIMARY KEY ( idIllustration, idFPE ),
	FOREIGN KEY ( idIllustration        ) REFERENCES onote.Illustration ( idIllustration ),
	FOREIGN KEY ( idFPE                 ) REFERENCES onote.FPE          ( idFPE          )
);
