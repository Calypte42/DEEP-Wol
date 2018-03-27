TRUNCATE TABLE SystemeHydrographique RESTART IDENTITY CASCADE;
TRUNCATE TABLE Grotte RESTART IDENTITY CASCADE;
TRUNCATE TABLE Site RESTART IDENTITY CASCADE;
TRUNCATE TABLE Personne RESTART IDENTITY CASCADE;
TRUNCATE TABLE Taxonomie RESTART IDENTITY CASCADE;
TRUNCATE TABLE Echantillon RESTART IDENTITY CASCADE;
TRUNCATE TABLE CorrespondanceGeneBacterie RESTART IDENTITY CASCADE;
TRUNCATE TABLE Compte RESTART IDENTITY CASCADE;


drop table Compte;
/*drop table LienFastaElectro;
drop table lienPCRFasta;
drop table lienqPCRFasta;*/
drop table qPCR;
drop table PCR;
/*drop table Fasta;
drop table Electrophoregramme;*/
drop table CorrespondanceGeneBacterie;
drop table Gene;
drop table Bacterie;
/*drop table PoolIn;
drop table Pool; */
drop table Echantillon;
drop table Taxonomie;
drop table Personne;
drop table Piege;
drop table Site;
drop table Grotte;
drop table SystemeHydrographique;
drop table EquipeSpeleo;
