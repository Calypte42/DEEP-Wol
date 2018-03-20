/* Ce fichier permet de creer des valeurs fictive pour les tests.
*/

INSERT INTO EquipeSpeleo VALUES ('Equipe1');
INSERT INTO EquipeSpeleo VALUES ('Equipe2');

INSERT INTO SystemeHydrographique (nom,departement) VALUES ('Reseau1',34);
INSERT INTO SystemeHydrographique (nom,departement) VALUES ('Reseau2',34);

INSERT INTO Grotte(nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic,idSystemeHydrographique)
    VALUES('Grotte1','Standard',NULL,NULL,'Normal',TRUE,1);
INSERT INTO Grotte(nomCavite,typeCavite,typeAcces,accesPublic,idSystemeHydrographique)
    VALUES('Grotte2','Standard','Normal',TRUE,1);
INSERT INTO Grotte(nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic,idSystemeHydrographique)
    VALUES('Grotte3','Standard',NULL,NULL,'Normal',FALSE,2);
INSERT INTO Grotte(nomCavite,typeCavite,typeAcces,accesPublic,idSystemeHydrographique)
    VALUES('Grotte4','Standard','Normal',TRUE,2);

INSERT INTO Site (numSite,distanceEntree,idGrotte,codeEquipeSpeleo)
    VALUES ('Equipe1Site1',25,1,'Equipe1');
INSERT INTO Site (numSite,distanceEntree,idGrotte,codeEquipeSpeleo)
    VALUES ('Equipe1Site2',30,1,'Equipe1');
INSERT INTO Site (numSite,distanceEntree,idGrotte,codeEquipeSpeleo)
    VALUES ('Equipe2Site1',20,1,'Equipe2');
INSERT INTO Site (numSite,distanceEntree,idGrotte,codeEquipeSpeleo)
    VALUES ('Equipe1Site3',50,2,'Equipe1');
INSERT INTO Site (numSite,distanceEntree,idGrotte,codeEquipeSpeleo)
    VALUES ('Equipe2Site2',3,2,'Equipe2');

INSERT INTO Piege (codePiege,codeEquipeSpeleo,IdSite)
    VALUES ('P111','Equipe1',1);
INSERT INTO Piege (codePiege,codeEquipeSpeleo,IdSite)
    VALUES ('P211','Equipe1',1);
INSERT INTO Piege (codePiege,codeEquipeSpeleo,IdSite)
    VALUES ('P112','Equipe1',2);

INSERT INTO Personne(nom,prenom)
    VALUES ('Lengrand','Aurelien');
INSERT INTO Personne(nom,prenom)
    VALUES ('Charpentier','Sofian');
INSERT INTO Personne(nom,prenom)
    VALUES ('Masclef','Diane');

INSERT INTO Taxonomie (classe)
    VALUES ('Mammalia');

INSERT INTO Individu (numIndividu,formeStockage,lieuStockage,codePiege)
    VALUES ('Individu1','Individu entier','Montpellier','P111');
INSERT INTO Individu (numIndividu,formeStockage,lieuStockage,codePiege)
    VALUES ('Individu2','Individu entier','Montpellier','P111');
INSERT INTO Individu (numIndividu,formeStockage,lieuStockage,codePiege)
    VALUES ('Individu3','Individu entier','Montpellier','P111');

INSERT INTO Gene(nom) VALUES ('Gene1');

INSERT INTO Bacterie(clade) VALUES ('A');

INSERT INTO CorrespondanceGeneBacterie (nomGene,clade)
    VALUES ('Gene1','A');

INSERT INTO PCR (resultat,idIndividu,nomGene,datePCR)
    VALUES ('ambigue',1,'Gene1','2018-09-03');

INSERT INTO Compte (pseudo,MDP)
    VALUES ('tutu','tutu');
