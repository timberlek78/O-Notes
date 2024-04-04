-- Insertion dans la table Etude
INSERT INTO onote.Etude (specialite, typeBac)
VALUES 
	('Informatique', 'Scientifique'),
	('Génie Civil', 'Technologique'),
	('Biologie', 'Scientifique');

-- Insertion dans la table Semestre
INSERT INTO onote.Semestre (numSemestre)
VALUES 
	(1), (2), (3), (4), (5), (6);

-- Insertion dans la table Competence
INSERT INTO onote.Competence (idCompetence, annee)
VALUES 
	('COMP001', '2025-2026'),
	('COMP002', '2025-2026'),
	('COMP003', '2025-2026'),
	('COMP004', '2025-2026'),
	('COMP005', '2025-2026'),
	('COMP006', '2025-2026');

-- Insertion dans la table Matiere
INSERT INTO onote.Matiere (idMatiere, alternant)
VALUES 
	('MAT001', FALSE),
	('MAT002', TRUE),
	('MAT003', FALSE),
	('MAT004', TRUE),
	('MAT005', TRUE),
	('MAT006', TRUE);

-- Insertion dans la table Utilisateur
INSERT INTO onote.Utilisateur (idUtilisateur, mdp)
VALUES 
	('user1', 'mdp123'),
	('user2', 'pass456'),
	('admin', 'adminpass');

-- Insertion dans la table Illustration
INSERT INTO onote.Illustration (idIllustration, img, alternative)
VALUES 
	(1, 'chemin/vers/image1.png', 'Description de l''image 1'),
	(2, 'chemin/vers/image2.png', 'Description de l''image 2'),
	(3, 'chemin/vers/image3.png', 'Description de l''image 3');

-- Insertion dans la table ConfigFPE
INSERT INTO onote.ConfigFPE (idConfigFPE, nomDirecteur, anneePromo)
VALUES 
	('CONF001', 'Directeur1', '2024-2027'),
	('CONF002', 'Directeur2', '2024-2027'),
	('CONF003', 'Directeur3', '2024-2027');

-- Insertion dans la table Etudiant
INSERT INTO onote.Etudiant (codeNIP, nom, prenom, parcours, promotion, specialite, typeBac)
VALUES 
	(1001, 'Dupont', 'Jean', 'Informatique', '2023', 'Informatique', 'Scientifique'),
	(1002, 'Durand', 'Marie', 'Mathématiques', '2025-2026', 'Informatique', 'Scientifique'),
	(1003, 'Lefevre', 'Pierre', 'Génie Civil', '2025', 'Informatique', 'Scientifique'),
	(1004, 'Bigard', 'Jean-Marie', 'Alcoolisme', '2025-2026', 'Informatique', 'Scientifique'),
	(1005, 'Grantunel', 'Celioche', 'A', '2023-2026', 'Informatique', 'Scientifique'),
	(1006, 'Verdict', 'Yanice', 'B', '2023-2026', 'Informatique', 'Scientifique'),
	(1007, 'Letremplin', 'Minimilien', 'A', '2023-2026', 'Informatique', 'Scientifique'),
	(1008, 'Pieceofgarlic', 'Tardmas', 'A', '2024-2027', 'Informatique', 'Scientifique'),
	(1009, 'Lavoine', 'Minime', 'A', '2024-2027', 'Informatique', 'Scientifique');

-- Insertion dans la table FPE
INSERT INTO onote.FPE (idFPE, AvisMaster, AvisEcoleInge, commentaire, codeNIP)
VALUES 
	('FPE001', 'Bon', 'Satisfaisant', 'Commentaire sur FPE 1', 1001),
	('FPE002', 'Très bien', 'Excellent', 'Commentaire sur FPE 2', 1002),
	('FPE003', 'Moyen', 'Acceptable', 'Commentaire sur FPE 3', 1003);

-- Insertion dans la table EtudiantSemestre
INSERT INTO onote.EtudiantSemestre (codeNIP, numSemestre, rang, nbAbs, passage)
VALUES 
	(1001, 1, 1, 2, 'O'),
	(1002, 1, 1, 1, 'O'),
	(1003, 1, 1, 3, 'O');

-- Insertion dans la table CompetenceMatiere
INSERT INTO onote.CompetenceMatiere (idCompetence, annee, idMatiere, coeff)
VALUES 
	('COMP001', '2025-2026', 'MAT001', 3),
	('COMP001', '2025-2026', 'MAT002', 2),
	('COMP001', '2025-2026', 'MAT003', 2),

	('COMP002', '2025-2026', 'MAT004', 1),
	('COMP002', '2025-2026', 'MAT005', 5),
	('COMP002', '2025-2026', 'MAT006', 2),
	
	('COMP003', '2025-2026', 'MAT001', 8),
	('COMP003', '2025-2026', 'MAT002', 6),
	('COMP003', '2025-2026', 'MAT004', 2),

	('COMP004', '2025-2026', 'MAT001', 1),
	('COMP004', '2025-2026', 'MAT003', 2),
	('COMP004', '2025-2026', 'MAT005', 3),

	('COMP005', '2025-2026', 'MAT001', 1),
	('COMP005', '2025-2026', 'MAT002', 2),
	('COMP005', '2025-2026', 'MAT003', 3),

	('COMP006', '2025-2026', 'MAT004', 1),
	('COMP006', '2025-2026', 'MAT003', 2),
	('COMP006', '2025-2026', 'MAT002', 3);

-- Insertion dans la table Cursus
INSERT INTO onote.Cursus (codeNIP, numSemestre, idCompetence, annee, admission)
VALUES 
	(1001, 1, 'COMP001', '2025-2026', 'ADM'),
	(1001, 1, 'COMP002', '2025-2026', 'AJ'),
	(1001, 1, 'COMP003', '2025-2026', 'CMP'),
	(1001, 1, 'COMP004', '2025-2026', 'ADSUP'),
	(1001, 1, 'COMP005', '2025-2026', 'ADM'),
	(1001, 1, 'COMP006', '2025-2026', 'ADM'),

	(1002, 1, 'COMP001', '2025-2026', 'ADM'),
	(1002, 1, 'COMP002', '2025-2026', 'ADSUP'),
	(1002, 1, 'COMP003', '2025-2026', 'AJ'),
	(1002, 1, 'COMP004', '2025-2026', 'CMP'),
	(1002, 1, 'COMP005', '2025-2026', 'AJ'),
	(1002, 1, 'COMP006', '2025-2026', 'ADM'),

	(1003, 1, 'COMP001', '2025-2026', 'ADM'),
	(1003, 1, 'COMP002', '2025-2026', 'ADM'),
	(1003, 1, 'COMP003', '2025-2026', 'AJ'),
	(1003, 1, 'COMP004', '2025-2026', 'ADSUP'),
	(1003, 1, 'COMP005', '2025-2026', 'ADM'),
	(1003, 1, 'COMP006', '2025-2026', 'CMP'),


	--Semestre 2
	(1001, 2, 'COMP001', '2025-2026', 'ADM'),
	(1001, 2, 'COMP002', '2025-2026', 'AJ'),
	(1001, 2, 'COMP003', '2025-2026', 'CMP'),
	(1001, 2, 'COMP004', '2025-2026', 'ADSUP'),
	(1001, 2, 'COMP005', '2025-2026', 'ADM'),
	(1001, 2, 'COMP006', '2025-2026', 'ADM'),

	(1002, 2, 'COMP001', '2025-2026', 'ADM'),
	(1002, 2, 'COMP002', '2025-2026', 'ADSUP'),
	(1002, 2, 'COMP003', '2025-2026', 'AJ'),
	(1002, 2, 'COMP004', '2025-2026', 'CMP'),
	(1002, 2, 'COMP005', '2025-2026', 'AJ'),
	(1002, 2, 'COMP006', '2025-2026', 'ADM'),

	(1003, 2, 'COMP001', '2025-2026', 'ADM'),
	(1003, 2, 'COMP002', '2025-2026', 'ADM'),
	(1003, 2, 'COMP003', '2025-2026', 'AJ'),
	(1003, 2, 'COMP004', '2025-2026', 'ADSUP'),
	(1003, 2, 'COMP005', '2025-2026', 'ADM'),
	(1003, 2, 'COMP006', '2025-2026', 'CMP'),

	--Semestre 3
	(1001, 3, 'COMP001', '2025-2026', 'ADM'),
	(1001, 3, 'COMP002', '2025-2026', 'AJ'),
	(1001, 3, 'COMP003', '2025-2026', 'CMP'),
	(1001, 3, 'COMP004', '2025-2026', 'ADSUP'),
	(1001, 3, 'COMP005', '2025-2026', 'ADM'),
	(1001, 3, 'COMP006', '2025-2026', 'ADM'),

	(1002, 3, 'COMP001', '2025-2026', 'ADM'),
	(1002, 3, 'COMP002', '2025-2026', 'ADSUP'),
	(1002, 3, 'COMP003', '2025-2026', 'AJ'),
	(1002, 3, 'COMP004', '2025-2026', 'CMP'),
	(1002, 3, 'COMP005', '2025-2026', 'AJ'),
	(1002, 3, 'COMP006', '2025-2026', 'ADM'),

	(1003, 3, 'COMP001', '2025-2026', 'ADM'),
	(1003, 3, 'COMP002', '2025-2026', 'ADM'),
	(1003, 3, 'COMP003', '2025-2026', 'AJ'),
	(1003, 3, 'COMP004', '2025-2026', 'ADSUP'),
	(1003, 3, 'COMP005', '2025-2026', 'ADM'),
	(1003, 3, 'COMP006', '2025-2026', 'CMP'),

	--Semestre 4
	(1001, 4, 'COMP001', '2025-2026', 'ADM'),
	(1001, 4, 'COMP002', '2025-2026', 'AJ'),
	(1001, 4, 'COMP003', '2025-2026', 'CMP'),
	(1001, 4, 'COMP004', '2025-2026', 'ADSUP'),
	(1001, 4, 'COMP005', '2025-2026', 'ADM'),
	(1001, 4, 'COMP006', '2025-2026', 'ADM'),

	(1002, 4, 'COMP001', '2025-2026', 'ADM'),
	(1002, 4, 'COMP002', '2025-2026', 'ADSUP'),
	(1002, 4, 'COMP003', '2025-2026', 'AJ'),
	(1002, 4, 'COMP004', '2025-2026', 'CMP'),
	(1002, 4, 'COMP005', '2025-2026', 'AJ'),
	(1002, 4, 'COMP006', '2025-2026', 'ADM'),

	(1003, 4, 'COMP001', '2025-2026', 'ADM'),
	(1003, 4, 'COMP002', '2025-2026', 'ADM'),
	(1003, 4, 'COMP003', '2025-2026', 'ADM'),
	(1003, 4, 'COMP004', '2025-2026', 'ADM'),
	(1003, 4, 'COMP005', '2025-2026', 'ADM'),
	(1003, 4, 'COMP006', '2025-2026', 'ADM');

-- Insertion dans la table Possede
INSERT INTO onote.Possede (idIllustration, idConfigFPE)
VALUES 
	(1, 'CONF001'),
	(2, 'CONF002'),
	(3, 'CONF003');

-- Insertion dans la table EstNote
INSERT INTO onote.EstNote (codeNIP, idMatiere, moyenne)
VALUES 
	(1001, 'MAT001', 15.5),
	(1001, 'MAT002', 9.5),
	(1001, 'MAT003', 16.5),
	(1001, 'MAT004', 0.5),
	(1001, 'MAT005', 13.5),
	(1001, 'MAT006', 20),

	(1002, 'MAT001', 5.8),
	(1002, 'MAT002', 6.8),
	(1002, 'MAT003', 11.8),
	(1002, 'MAT004', 3.8),
	(1002, 'MAT005', 8.8),
	(1002, 'MAT006', 7.2),

	(1003, 'MAT001', 16.2),
	(1003, 'MAT002', 17.2),
	(1003, 'MAT003', 19.2),
	(1003, 'MAT004', 18.2),
	(1003, 'MAT005', 15.2),
	(1003, 'MAT006', 14.2);
