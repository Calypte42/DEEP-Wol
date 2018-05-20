<?php

// Fonctionnel !

include '../BDD/bdd.php';
$bdd = connexionbd();

$id = $_REQUEST['id'];

if ($_REQUEST['formeStockage']  == 'autre') {
    $formeStockage = $_REQUEST['autreFormeStockage'];
} else {
    $formeStockage = $_REQUEST['formeStockage'];
}

if ($_REQUEST['lieuStockage'] == 'autre') {
    $lieuStockage = $_REQUEST['autreLieuStockage'];
} else {
    $lieuStockage = $_REQUEST['lieuStockage'];
}

/* A cause des null dans la base de donnee on doit mettre en place
des IS NULL dans les requetes, on ne peut donc pas utiliser la
syntaxe :variable dans le prepare.
De ce fait si il faut comparer a null on modifie la syntaxe
des requetes.
On construit egalement les tableaux des execute au fur et a mesure */

$taxoRequete='';
$debutTaxoRequete='SELECT * FROM Taxonomie t WHERE ';
$tableau = array();

// Gestion des classes
if ($_REQUEST['classe']=='Indetermine') {
    $classe='';
    $taxoRequete= $taxoRequete."t.classe ='' ";
} else {
    $classe=$_REQUEST['classe'];
    $taxoRequete=$taxoRequete."t.classe =:classe ";
    $tableau['classe']= $classe;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des ordres
if ($_REQUEST['ordre']=='Indetermine') {
    $ordre='';
    $taxoRequete= $taxoRequete."t.ordre ='' ";
} else {
    $ordre=$_REQUEST['ordre'];
    $taxoRequete=$taxoRequete."t.ordre =:ordre ";
    $tableau['ordre']=$ordre;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des familles
if ($_REQUEST['famille']=='Indetermine') {
    $famille='';
    $taxoRequete= $taxoRequete."t.famille ='' ";
} else {
    $famille=$_REQUEST['famille'];
    $taxoRequete=$taxoRequete."t.famille =:famille ";
    $tableau['famille']=$famille;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des sousFamilles

if ($_REQUEST['sousFamille']=='Indetermine') {
    $sousFamille='';
    $taxoRequete= $taxoRequete."t.sousFamille ='' ";
} else {
    $sousFamille=$_REQUEST['sousFamille'];
    $taxoRequete=$taxoRequete."t.sousFamille =:sousFamille ";
    $tableau['sousFamille']=$sousFamille;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des genres
if ($_REQUEST['genre']=='Indetermine') {
    $genre='';
    $taxoRequete= $taxoRequete."t.genre ='' ";
} else {
    $genre=$_REQUEST['genre'];
    $taxoRequete=$taxoRequete."t.genre =:genre ";
    $tableau['genre']=$genre;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des especes
if ($_REQUEST['espece']=='Indetermine') {
    $espece='';
    $taxoRequete= $taxoRequete."t.espece ='' ";
} else {
    $espece=$_REQUEST['espece'];
    $taxoRequete=$taxoRequete."t.espece =:espece ";
    $tableau['espece']=$espece;
}

//$taxoRequete=$taxoRequete.';';


$maRequeteVerif = $debutTaxoRequete.$taxoRequete;


$reqVerif = $bdd->prepare($maRequeteVerif.';');

$reqVerif->execute($tableau);

$nombreResultat=$reqVerif->rowCount();

if ($nombreResultat==1) {
    $req = $bdd->prepare("UPDATE Echantillon SET numEchantillon=:numEchantillon,nombreIndividu=:nombreIndividu,
        formeStockage=:formeStockage,lieuStockage=:lieuStockage, niveauIdentification=:niveauIdentification,
        infecteBacterie=:infecteBacterie,idAuteur=:idAuteur,idTaxonomie=(SELECT id FROM Taxonomie t WHERE $taxoRequete) WHERE id=:id;");


    $tableau['numEchantillon']= $_REQUEST['numEchantillon'];
    if ($_REQUEST['type']=='Pool') {
        $tableau['nombreIndividu']= $_REQUEST['nombreIndividu'];
    } else {
        $tableau['nombreIndividu']=1;
    }
    $tableau['formeStockage']= $formeStockage;
    $tableau['lieuStockage']= $lieuStockage;
    $tableau['niveauIdentification']= $_REQUEST['niveauIdentification'];
    $tableau['infecteBacterie']= $_REQUEST['infecteBacterie'];
    $tableau['idAuteur']= $_REQUEST['idAuteur'];
    $tableau['id']= $_REQUEST['id'];

    $req->execute($tableau);


    if($_REQUEST['infecteBacterie'] =="nonDetermine"){
        $req = $bdd->prepare('DELETE FROM CorrespondanceEchantillonBacterie WHERE idEchantillon = :idEchantillon');
        $entre['idEchantillon']= $id;
        $req->execute($entre);
    } elseif ($_REQUEST['infecteBacterie']=="non") {
        $req = $bdd->prepare('DELETE FROM CorrespondanceEchantillonBacterie WHERE idEchantillon = :idEchantillon');
        $entre['idEchantillon']= $id;
        $req->execute($entre);
    } else {
        $requete="SELECT clade FROM CorrespondanceEchantillonBacterie WHERE idEchantillon=$id";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
        $bacteries=requete($bdd,$requete);

        $listeBacterie = [];
        $nouvelleListeBacterie = $_REQUEST['bacterie'];

        foreach ($bacteries as $array) {
            $listeBacterie[] = $array['clade'];
        }

        foreach ($listeBacterie as $bacterie) {
            if (!in_array($bacterie, $nouvelleListeBacterie)){
                $req = $bdd->prepare('DELETE FROM CorrespondanceEchantillonBacterie WHERE idEchantillon = :idEchantillon AND clade = :clade');
                $entre['idEchantillon']= $id;
                $entre['clade']= $bacterie;
                $req->execute($entre);
            }
        }
        foreach ($nouvelleListeBacterie as $bacterie) {
            if (!in_array($bacterie, $listeBacterie)){
                $req = $bdd->prepare('INSERT INTO CorrespondanceEchantillonBacterie VALUES (:idEchantillon,:clade)');
                $entre['idEchantillon']= $id;
                $entre['clade']= $bacterie;
                $req->execute($entre);
            }
        }
    }

    header("Refresh: 0; URL=../tableauEchantillon.php?nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['codePiege']);
} else {
    echo "Il y a ".$nombreResultat." Taxonomie correspondante ! ";
}
