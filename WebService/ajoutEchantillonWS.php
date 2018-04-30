<?php

// Fonctionnel !

include '../BDD/bdd.php';
$bdd = connexionbd();


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
    $classe=null;
    $taxoRequete= $taxoRequete."t.classe IS NULL ";
} else {
    $classe=$_REQUEST['classe'];
    $taxoRequete=$taxoRequete."t.classe =:classe ";
    $tableau['classe']= $classe;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des ordres
if ($_REQUEST['ordre']=='Indetermine') {
    $ordre=null;
    $taxoRequete= $taxoRequete."t.ordre IS NULL ";
} else {
    $ordre=$_REQUEST['ordre'];
    $taxoRequete=$taxoRequete."t.ordre =:ordre ";
    $tableau['ordre']=$ordre;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des familles
if ($_REQUEST['famille']=='Indetermine') {
    $famille=null;
    $taxoRequete= $taxoRequete."t.famille IS NULL ";
} else {
    $famille=$_REQUEST['famille'];
    $taxoRequete=$taxoRequete."t.famille =:famille ";
    $tableau['famille']=$famille;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des sousFamilles

if ($_REQUEST['sousFamille']=='Indetermine') {
    $sousFamille=null;
    $taxoRequete= $taxoRequete."t.sousFamille IS NULL ";
} else {
    $sousFamille=$_REQUEST['sousFamille'];
    $taxoRequete=$taxoRequete."t.sousFamille =:sousFamille ";
    $tableau['sousFamille']=$sousFamille;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des genres
if ($_REQUEST['genre']=='Indetermine') {
    $genre=null;
    $taxoRequete= $taxoRequete."t.genre IS NULL ";
} else {
    $genre=$_REQUEST['genre'];
    $taxoRequete=$taxoRequete."t.genre =:genre ";
    $tableau['genre']=$genre;
}

$taxoRequete=$taxoRequete."AND ";

// Gestion des especes
if ($_REQUEST['espece']=='Indetermine') {
    $espece=null;
    $taxoRequete= $taxoRequete."t.espece IS NULL ";
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
    $req = $bdd->prepare('INSERT INTO Echantillon (numEchantillon,nombreIndividu,formeStockage,lieuStockage,
    niveauIdentification,infecteBacterie,codePiege,idAuteur,idTaxonomie)
   SELECT :numEchantillon,:nombreIndividu,:formeStockage,:lieuStockage,:niveauIdentification,:infecteBacterie,:codePiege,
   :idAuteur,t.id FROM Taxonomie t WHERE '.$taxoRequete.';');


    $tableau['numEchantillon']= $_REQUEST['numEchantillon'];
    if ($_REQUEST['type']=='Pool') {
        $tableau['nombreIndividu']= $_REQUEST['nombreIndividu'];
    } else {
        $tableau['nombreIndividu']=1;
    }
    $tableau['formeStockage']= $_REQUEST['formeStockage'];
    $tableau['lieuStockage']= $_REQUEST['lieuStockage'];
    $tableau['niveauIdentification']= $_REQUEST['niveauIdentification'];
    $tableau['infecteBacterie']= $_REQUEST['infecteBacterie'];
    $tableau['codePiege']= $_REQUEST['codePiege'];
    $tableau['idAuteur']= $_REQUEST['idAuteur'];


    $req->execute($tableau);

    if ($_REQUEST['nom']=='Valider et ajouter un nouvel échantillon') {
        if (isset($_REQUEST['idGrotte'])) {
            header("Refresh: 0; URL=../ajoutEchantillon.php?nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['codePiege']);
        } else {
            header("Refresh: 0; URL=../ajoutEchantillon.php");
        }
    }

    if ($_REQUEST['nom']=='Valider et revenir au tableau des échantillons') {
        header("Refresh: 0; URL=../tableauEchantillon.php?nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['codePiege']);
    }
} else {
    echo "Il y a ".$nombreResultat." Taxonomie correspondante ! ";
}


echo http_response_code();
