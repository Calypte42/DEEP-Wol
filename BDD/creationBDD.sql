create table EquipeSpeleo (
    codeEquipe varchar(20) PRIMARY KEY
);

create table SystemeHydrographique (
    id SERIAL PRIMARY KEY,
    nom varchar(30) NOT NULL,
    departement int,
    pays varchar(4) NOT NULL,
    CONSTRAINT departement_sup0 CHECK (departement>=0),
    CONSTRAINT systemeHydro_unique UNIQUE (nom, departement, pays)
);

create table Grotte (
    id SERIAL PRIMARY KEY,
    nomCavite varchar(50) UNIQUE NOT NULL,
    typeCavite varchar(20),
    latitude varchar(20),
    longitude varchar(20),
    typeAcces varchar(20),
    accesPublic boolean,
    idSystemeHydrographique int,
    CONSTRAINT SystemeHydrographique_FK FOREIGN KEY (idSystemeHydrographique)
        REFERENCES SystemeHydrographique (id) ON DELETE SET NULL
);

create table Site (
    id SERIAL PRIMARY KEY,
    profondeur float,
    typeSol varchar(20),
    numSite varchar(40) NOT NULL,
    distanceEntree float NOT NULL,
    presenceEau boolean,
    idGrotte int NOT NULL,
    codeEquipeSpeleo varchar(20) NOT NULL,
    CONSTRAINT site_unique UNIQUE (numsite, idGrotte, codeEquipeSpeleo),
    CONSTRAINT idGrotte_FK FOREIGN KEY (idGrotte)
        REFERENCES Grotte (id) ON DELETE CASCADE,
    CONSTRAINT codeEquipeSpeleo_FK FOREIGN KEY (codeEquipeSpeleo)
        REFERENCES EquipeSpeleo(codeEquipe) ON UPDATE CASCADE ON DELETE CASCADE
);

create table Piege (
    codePiege varchar(10) PRIMARY KEY,
    datePose date,
    heurePose time,
    dateRecup date,
    heureRecup time,
    probleme varchar(200),
    dateTri date,
    temperature float,
    codeEquipeSpeleo varchar(20) NOT NULL,
    IdSite int NOT NULL,
    CONSTRAINT piege_unique UNIQUE (codePiege, codeEquipeSpeleo, IdSite),
    CONSTRAINT EquipeSpeleo_FK FOREIGN KEY (codeEquipeSpeleo)
        REFERENCES EquipeSpeleo (codeEquipe) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT site_FK FOREIGN KEY (IdSite)
        REFERENCES Site (id) ON DELETE CASCADE
);

create table Personne (
    id SERIAL PRIMARY KEY,
    initiale varchar(4) UNIQUE
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
    numEchantillon varchar(20) UNIQUE NOT NULL,
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
        REFERENCES Piege (codePiege) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT idAuteur_FK FOREIGN KEY (idAuteur)
        REFERENCES Personne (id) ON DELETE SET NULL,
    CONSTRAINT idTaxonomie_FK FOREIGN KEY (idTaxonomie)
        REFERENCES Taxonomie (id) ON DELETE SET NULL
);


create table Gene (
    nom varchar(20) PRIMARY KEY
);

create table CorrespondanceEchantillonBacterie (
    idEchantillon int NOT NULL,
    clade varchar(1) NOT NULL,
    CONSTRAINT idEchantillon_FK FOREIGN KEY (idEchantillon)
        REFERENCES Echantillon(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT CorrespondanceEchantillonBacterie_PK PRIMARY KEY (idEchantillon,clade)
);

create table Analyses (
    id SERIAL PRIMARY KEY,
    resultat varchar(10) NOT NULL,
    type varchar(4) NOT NULL,
    idEchantillon int NOT NULL,
    nomGene varchar(20) NOT NULL,
    dateAnalyse date NOT NULL,
    fasta varchar(200),
    electrophoregramme varchar(200),
    CONSTRAINT idEchantillon_FK FOREIGN KEY (idEchantillon)
        REFERENCES Echantillon (id) ON DELETE CASCADE,
    CONSTRAINT Analyse_dateEchantillonGene_UNIQUE UNIQUE (dateAnalyse,idEchantillon,nomGene)
);

create table Compte (
    id SERIAL PRIMARY KEY,
    pseudo varchar(30) UNIQUE,
    MDP varchar(20),
    role varchar(5),
    CONSTRAINT admin_user CHECK (role='admin' OR role='user')
);

CREATE VIEW V_Echantillon_AvecTaxo AS
SELECT numEchantillon,formeStockage,lieuStockage,niveauIdentification,infecteBacterie,nombreIndividu,piege.codepiege,datepose,heurepose,daterecup,heurerecup,probleme,datetri,profondeur,temperature,typesol,numsite,distanceentree,presenceeau,nomcavite,typecavite,latitude,longitude,typeacces,accespublic,sys.nom AS nomSystemeHydrographique,departement,classe,ordre,famille,sousfamille,genre,espece,photo,p.initiale AS initialeAuteur from Echantillon e, Taxonomie t, Personne p, Piege piege, Site site, Grotte grotte, systemeHydrographique sys WHERE (e.idTaxonomie=t.id) AND (e.idAuteur=p.id) AND (e.codePiege=piege.codePiege) AND (piege.idSite=site.id) AND (site.idGrotte=grotte.id) AND (grotte.idSystemeHydrographique=sys.id);

CREATE VIEW V_Analyse AS
SELECT resultat,type,nomGene,dateAnalyse,fasta,electrophoregramme,numEchantillon,formeStockage,lieuStockage,niveauIdentification,infecteBacterie,nombreIndividu,piege.codepiege,datepose,heurepose,daterecup,heurerecup,probleme,datetri,profondeur,temperature,typesol,numsite,distanceentree,presenceeau,nomcavite,typecavite,latitude,longitude,typeacces,accespublic,sys.nom AS nomSystemeHydrographique,departement,classe,ordre,famille,sousfamille,genre,espece,photo,p.initiale AS initialeAuteur from Analyses analyses,Echantillon e, Taxonomie t, Personne p, Piege piege, Site site, Grotte grotte, systemeHydrographique sys WHERE (analyses.idEchantillon=e.id) AND (e.idTaxonomie=t.id) AND (e.idAuteur=p.id) AND (e.codePiege=piege.codePiege) AND (piege.idSite=site.id) AND (site.idGrotte=grotte.id) AND (grotte.idSystemeHydrographique=sys.id);

/*
CREATE VIEW V_Analyse_Fasta AS
SELECT fasta from Analyses analyses,Echantillon e, Taxonomie t, Personne p, Piege piege, Site site, Grotte grotte, systemeHydrographique sys WHERE (analyses.idEchantillon=e.id) AND(e.idTaxonomie=t.id) AND (e.idAuteur=p.id) AND (e.codePiege=piege.codePiege) AND (piege.idSite=site.id) AND (site.idGrotte=grotte.id) AND (grotte.idSystemeHydrographique=sys.id);
*/
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
TRUNCATE TABLE Compte RESTART IDENTITY CASCADE;
