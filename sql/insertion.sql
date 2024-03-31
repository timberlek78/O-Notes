-- Insertion dans la table Semestre
INSERT INTO onote.Semestre;
INSERT INTO onote.Semestre;
INSERT INTO onote.Semestre;
INSERT INTO onote.Semestre;
INSERT INTO onote.Semestre;

-- Insertion dans la table Competence
INSERT INTO onote.Competence (libelle) VALUES
('Compétence 1'),
('Compétence 2'),
('Compétence 3'),
('Compétence 4'),
('Compétence 5');

-- Insertion dans la table Matiere
INSERT INTO onote.Matiere (moyenne, coeff, alternant, libelle) VALUES
(15.5, 2, TRUE, 'Mathématiques'),
(14.2, 3, FALSE, 'Physique'),
(16.8, 1, TRUE, 'Français'),
(12.0, 2, FALSE, 'Histoire'),
(17.5, 3, TRUE, 'Chimie');

-- Insertion dans la table Utilisateur
INSERT INTO onote.Utilisateur (nom, mdp) VALUES
('Utilisateur 1', 'mdp1'),
('Utilisateur 2', 'mdp2'),
('Utilisateur 3', 'mdp3'),
('Utilisateur 4', 'mdp4'),
('Utilisateur 5', 'mdp5');

-- Insertion dans la table Illustration
INSERT INTO onote.Illustration (alternative) VALUES
('Illustration 1'),
('Illustration 2'),
('Illustration 3'),
('Illustration 4'),
('Illustration 5');

-- Insertion dans la table FPE
INSERT INTO onote.FPE (nomDirecteur, anneePromoFin, anneePromoDebut) VALUES
('Directeur 1', 2024, 2023),
('Directeur 2', 2023, 2022),
('Directeur 3', 2022, 2021),
('Directeur 4', 2021, 2020),
('Directeur 5', 2020, 2019);

-- Insertion dans la table Etudiant
INSERT INTO onote.Etudiant (codeNIP, nom, prenom, parcours, promotion, idIllustration) VALUES
(12345, 'Etudiant 1', 'Prenom1', 'Parcours 1', 'Promo 1', 1),
(67890, 'Etudiant 2', 'Prenom2', 'Parcours 2', 'Promo 2', 2),
(54321, 'Etudiant 3', 'Prenom3', 'Parcours 3', 'Promo 3', 3),
(98765, 'Etudiant 4', 'Prenom4', 'Parcours 4', 'Promo 4', 4),
(13579, 'Etudiant 5', 'Prenom5', 'Parcours 5', 'Promo 5', 5);

-- Insertion dans la table Etude
INSERT INTO onote.Etude (specialite, typeBac, idEtudiant) VALUES
('Informatique', 'S', 1),
('Biologie', 'ES', 2),
('Chimie', 'L', 3),
('Physique', 'S', 4),
('Mathématiques', 'ES', 5);

-- Insertion dans la table EtudiantSemestre
INSERT INTO onote.EtudiantSemestre (numSemestre, idEtudiant, passage, rang, nbAbsences) VALUES
(1, 1, 'ADM', 1, 0),
(2, 2, 'ADSUP', 2, 1),
(3, 3, 'AJ', 3, 2),
(4, 4, 'CMP', 4, 3),
(5, 5, 'ADM', 5, 4);

-- Insertion dans la table CompetenceMatiere
INSERT INTO onote.CompetenceMatiere (numCompt, numMatiere) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- Insertion dans la table Cursus
INSERT INTO onote.Cursus (idEtudiant, numSemestre, numCompt, admission) VALUES
(1, 1, 1, 'ADM'),
(2, 2, 2, 'NAR'),
(3, 3, 3, 'NAR'),
(4, 4, 4, 'NAR'),
(5, 5, 5, 'ADM');

-- Insertion dans la table Possede
INSERT INTO onote.Possede (idIllustration, idFPE) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);
