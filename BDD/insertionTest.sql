/* Ce fichier permet de creer des valeurs fictive pour les tests.
*/

INSERT INTO EquipeSpeleo VALUES ('Equipe1');
INSERT INTO EquipeSpeleo VALUES ('Equipe2');

INSERT INTO SystemeHydrographique (nom,departement,pays) VALUES ('Reseau1',34,'FR');
INSERT INTO SystemeHydrographique (nom,departement,pays) VALUES ('Reseau2',34,'FR');

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

INSERT INTO Personne(initiale)
    VALUES ('L A');
INSERT INTO Personne(initiale)
    VALUES ('C S');
INSERT INTO Personne(initiale)
    VALUES ('M D');

INSERT INTO Taxonomie (classe)
    VALUES ('Collembola');


INSERT INTO Echantillon (numEchantillon,formeStockage,lieuStockage,codePiege,nombreIndividu,idTaxonomie,idAuteur)
SELECT 'Individu1','Individu entier','Montpellier','P111',1,t.id,1 FROM Taxonomie t WHERE t.classe='Collembola';
INSERT INTO Echantillon (numEchantillon,formeStockage,lieuStockage,codePiege,nombreIndividu,idTaxonomie,idAuteur)
SELECT 'Individu2','Individu entier','Montpellier','P111',1,t.id,1 FROM Taxonomie t WHERE t.classe='Collembola';
INSERT INTO Echantillon (numEchantillon,formeStockage,lieuStockage,codePiege,nombreIndividu,idTaxonomie,idAuteur)
SELECT 'Pool1','Individu entier','Montpellier','P111',10,t.id,1 FROM Taxonomie t WHERE t.classe='Collembola';



INSERT INTO Compte (pseudo,MDP)
    VALUES ('tutu','tutu'),('admin','admin');
