-- Insertion dans la table Semestre
INSERT INTO onote.Semestre (numSemestre) VALUES
(1),
(2),
(3);

-- Insertion dans la table Competence
INSERT INTO onote.Competence (numCompt, libelle) VALUES
(1, 'Compétence 1'),
(2, 'Compétence 2'),
(3, 'Compétence 3');

-- Insertion dans la table Matiere
INSERT INTO onote.Matiere (numMatiere, moyenne, coeff, alternant, libelle) VALUES
(1, 15.5, 2, TRUE, 'Mathématiques'),
(2, 14.2, 3, FALSE, 'Physique'),
(3, 16.8, 1, TRUE, 'Français');

-- Insertion dans la table Utilisateur
INSERT INTO onote.Utilisateur (idUser, nom, mdp) VALUES
('utilisateur1', 'Utilisateur 1', 'mdp1'),
('utilisateur2', 'Utilisateur 2', 'mdp2'),
('utilisateur3', 'Utilisateur 3', 'mdp3');

-- Insertion dans la table Illustration
INSERT INTO onote.Illustration (idIllustration, alternative) VALUES
(1, 'Illustration 1'),
(2, 'Illustration 2'),
(3, 'Illustration 3');

-- Insertion dans la table FPE
INSERT INTO onote.FPE (idFPE, nomDirecteur, anneePromo) VALUES
(1, 'Directeur 1', '2023-2024'),
(2, 'Directeur 2', '2022-2023'),
(3, 'Directeur 3', '2021-2022');

-- Insertion dans la table Etudiant
INSERT INTO onote.Etudiant (idEtudiant, codeNIP, nom, prenom, parcours, promotion, idIllustration) VALUES
(1, 12345, 'Etudiant 1', 'Prenom1', 'Parcours 1', 'Promo 1', 1),
(2, 67890, 'Etudiant 2', 'Prenom2', 'Parcours 2', 'Promo 2', 2),
(3, 54321, 'Etudiant 3', 'Prenom3', 'Parcours 3', 'Promo 3', 3);

-- Insertion dans la table Etude
INSERT INTO onote.Etude (idEtude, specialite, typeBac, idEtudiant) VALUES
(1, 'Informatique', 'S', 1),
(2, 'Biologie', 'ES', 2),
(3, 'Chimie', 'L', 3);

-- Insertion dans la table EtudiantSemestre
INSERT INTO onote.EtudiantSemestre (idEtudiant, numSemestre, passage, rang, nbAbsences) VALUES
(1, 1, 'O', 1, 0),
(2, 2, 'O', 2, 1),
(3, 3, 'R', 3, 2);

-- Insertion dans la table CompetenceMatiere
INSERT INTO onote.CompetenceMatiere (numCompt, numMatiere) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Insertion dans la table Cursus
INSERT INTO onote.Cursus (idEtudiant, numSemestre, numCompt, admission) VALUES
(1, 1, 1, 'Admis'),
(2, 2, 2, 'Admis'),
(3, 3, 3, 'Refusé');

-- Insertion dans la table Possede
INSERT INTO onote.Possede (idIllustration, idFPE) VALUES
(1, 1),
(2, 2),
(3, 3);
