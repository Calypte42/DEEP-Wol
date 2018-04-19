create table EquipeSpeleo (
    codeEquipe varchar(20) PRIMARY KEY
);

create table SystemeHydrographique (
    id SERIAL PRIMARY KEY,
    nom varchar(30),
    departement int,
    CONSTRAINT departement_sup0 CHECK (departement>=0)
);

create table Grotte (
    id SERIAL PRIMARY KEY,
    nomCavite varchar(50) UNIQUE NOT NULL,
    typeCavite varchar(20),
    latitude varchar(10),
    longitude varchar(10),
    typeAcces varchar(20),
    accesPublic boolean,
    idSystemeHydrographique int,
    CONSTRAINT SystemeHydrographique_FK FOREIGN KEY (idSystemeHydrographique)
        REFERENCES SystemeHydrographique (id)
);

create table Site (
    id SERIAL PRIMARY KEY,
    profondeur float,
    temperature float,
    typeSol varchar(20),
    numSite varchar(40) NOT NULL,
    distanceEntree float NOT NULL,
    presenceEau boolean,
    idGrotte int NOT NULL,
    codeEquipeSpeleo varchar(20) NOT NULL,
    CONSTRAINT idGrotte_FK FOREIGN KEY (idGrotte)
        REFERENCES Grotte (id),
    CONSTRAINT codeEquipeSpeleo_FK FOREIGN KEY (codeEquipeSpeleo)
        REFERENCES EquipeSpeleo(codeEquipe) ON UPDATE CASCADE
);

create table Piege (
    codePiege varchar(10) PRIMARY KEY,
    datePose date,
    heurePose time,
    dateRecup date,
    heureRecup time,
    probleme varchar(200),
    dateTri date,
    codeEquipeSpeleo varchar(20) NOT NULL,
    IdSite int NOT NULL,
    CONSTRAINT EquipeSpeleo_FK FOREIGN KEY (codeEquipeSpeleo)
        REFERENCES EquipeSpeleo (codeEquipe) ON UPDATE CASCADE,
    CONSTRAINT site_FK FOREIGN KEY (IdSite)
        REFERENCES Site (id)
);

create table Personne (
    id SERIAL PRIMARY KEY,
    initiale varchar(4)
);

create table Taxonomie (
    id SERIAL PRIMARY KEY,
    classe varchar(40) NOT NULL,
    ordre varchar(40),
    famille varchar(40),
    sousFamille varchar(40),
    genre varchar(40),
    espece varchar(40),
    photo varchar(200),
    CONSTRAINT taxo_unique UNIQUE (classe,ordre,famille,sousFamille,genre,espece)
);

create table Echantillon (
    id SERIAL PRIMARY KEY,
    numEchantillon varchar(20) NOT NULL,
    formeStockage varchar(32) NOT NULL,
    lieuStockage varchar(20) NOT NULL,
    niveauIdentification varchar(12),
    infecteBacterie varchar(12),
    codePiege varchar(10) NOT NULL,
    idAuteur int,
    idTaxonomie int,
    nombreIndividu int,
    CONSTRAINT nbrIndividu_0 CHECK (nombreIndividu >=0),
    CONSTRAINT codePiege_FK FOREIGN KEY (codePiege)
        REFERENCES Piege (codePiege) ON UPDATE CASCADE,
    CONSTRAINT idAuteur_FK FOREIGN KEY (idAuteur)
        REFERENCES Personne (id),
    CONSTRAINT idTaxonomie_FK FOREIGN KEY (idTaxonomie)
        REFERENCES Taxonomie (id)
);


create table Gene (
    nom varchar(20) PRIMARY KEY
);

create table Bacterie (
    clade varchar(1) PRIMARY KEY
);

create table CorrespondanceGeneBacterie (
    id SERIAL PRIMARY KEY,
    nomGene varchar(20) NOT NULL,
    clade varchar(1) NOT NULL,
    CONSTRAINT nomGene_FK FOREIGN KEY (nomGene)
        REFERENCES Gene(nom) ON UPDATE CASCADE,
    CONSTRAINT clade_FK FOREIGN KEY (clade)
        REFERENCES Bacterie (clade) ON UPDATE CASCADE
);

create table PCR (
    id SERIAL PRIMARY KEY,
    resultat varchar(10) NOT NULL,
    idEchantillon int NOT NULL,
    nomGene varchar(20) NOT NULL,
    datePCR date NOT NULL,
    fasta varchar(200),
    electrophoregramme varchar(200),
    CONSTRAINT idEchantillon_FK FOREIGN KEY (idEchantillon)
        REFERENCES Echantillon (id),
    CONSTRAINT nomGene_FK FOREIGN KEY (nomGene)
        REFERENCES Gene (nom) ON UPDATE CASCADE,
    CONSTRAINT PCR_dateEchantillonGene_UNIQUE UNIQUE (datePCR,idEchantillon,nomGene)
);

create table qPCR (
    id SERIAL PRIMARY KEY,
    resultat varchar(10)NOT NULL,
    idEchantillon int NOT NULL,
    nomGene varchar(20) NOT NULL,
    dateqPCR date NOT NULL,
    fasta varchar(200),
    electrophoregramme varchar(200),
    CONSTRAINT idEchantillon_FK FOREIGN KEY (idEchantillon)
        REFERENCES Echantillon (id),
    CONSTRAINT nomGene_FK FOREIGN KEY (nomGene)
        REFERENCES Gene (nom) ON UPDATE CASCADE,
    CONSTRAINT qPCR_dateEchantillonGene_UNIQUE UNIQUE (dateqPCR,idEchantillon,nomGene)
);


create table Compte (
    id SERIAL PRIMARY KEY,
    pseudo varchar(30),
    MDP varchar(20)
);

CREATE VIEW V_Echantillon_AvecTaxo AS
SELECT numEchantillon,formeStockage,lieuStockage,niveauIdentification,infecteBacterie,nombreIndividu,piege.codepiege,datepose,heurepose,daterecup,heurerecup,probleme,datetri,profondeur,temperature,typesol,numsite,distanceentree,presenceeau,nomcavite,typecavite,latitude,longitude,typeacces,accespublic,sys.nom AS nomSystemeHydrographique,departement,classe,ordre,famille,sousfamille,genre,espece,photo,p.initiale AS initialeAuteur from Echantillon e, Taxonomie t, Personne p, Piege piege, Site site, Grotte grotte, systemeHydrographique sys WHERE (e.idTaxonomie=t.id) AND (e.idAuteur=p.id) AND (e.codePiege=piege.codePiege) AND (piege.idSite=site.id) AND (site.idGrotte=grotte.id) AND (grotte.idSystemeHydrographique=sys.id);

/*
CREATE VIEW V_Fasta AS
SELECT pcr.fasta AS fastaPCR,qpcr.fasta as fastaQPCR from
  PCR pcr, qPCR qpcr, Gene g,Echantillon e, Taxonomie t, Personne p, Piege piege, Site site, Grotte grotte, systemeHydrographique sys
 WHERE (e.idTaxonomie=t.id) AND (e.idAuteur=p.id) AND (e.codePiege=piege.codePiege) AND (piege.idSite=site.id) AND (site.idGrotte=grotte.id) AND (grotte.idSystemeHydrographique=sys.id) AND (pcr.idEchantillon=e.id) AND (qpcr.idEchantillon=e.id) AND (g.nom=pcr.nomGene) AND (g.nom=qpcr.nomGene);
*/


/*
CREATE VIEW V_Echantillon_SansTaxo
AS SELECT numEchantillon,formeStockage,lieuStockage,niveauIdentification,infecteBacterie,nombreindividu,piege.codepiege,datepose,heurepose,daterecup,heurerecup,probleme,datetri,profondeur,temperature,typesol,numsite,distanceentree,presenceeau,nomcavite,typecavite,latitude,longitude,typeacces,accespublic,sys.nom AS nomSystemeHydrographique,departement FROM Echantillon e, Piege piege, Site site, Grotte grotte, systemeHydrographique sys WHERE (e.idTaxonomie IS NULL) AND (e.idAuteur IS NULL) AND (e.codePiege=piege.codePiege)  AND (piege.idSite=site.id) AND (site.idGrotte=grotte.id) AND (grotte.idSystemeHydrographique=sys.id);
*/

/*
La commande TRUNCATE permet de remettre les valeurs des SERIALS
a zero */


TRUNCATE TABLE SystemeHydrographique RESTART IDENTITY CASCADE;
TRUNCATE TABLE Grotte RESTART IDENTITY CASCADE;
TRUNCATE TABLE Site RESTART IDENTITY CASCADE;
TRUNCATE TABLE Personne RESTART IDENTITY CASCADE;
TRUNCATE TABLE Taxonomie RESTART IDENTITY CASCADE;
TRUNCATE TABLE Echantillon RESTART IDENTITY CASCADE;
TRUNCATE TABLE CorrespondanceGeneBacterie RESTART IDENTITY CASCADE;
TRUNCATE TABLE Compte RESTART IDENTITY CASCADE;
