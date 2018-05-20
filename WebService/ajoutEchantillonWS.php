<?php

// Fonctionnel !

include '../BDD/bdd.php';
$bdd = connexionbd();


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
    $tableau['formeStockage']= $formeStockage;
    $tableau['lieuStockage']= $lieuStockage;
    $tableau['niveauIdentification']= $_REQUEST['niveauIdentification'];
    $tableau['infecteBacterie']= $_REQUEST['infecteBacterie'];
    $tableau['codePiege']= $_REQUEST['codePiege'];
    $tableau['idAuteur']= $_REQUEST['idAuteur'];

    $req->execute($tableau);

    $idEchantillon= $bdd->lastInsertId();


    if($_REQUEST['infecteBacterie'] !="nonDetermine" and $_REQUEST['infecteBacterie'] !="non"){

        foreach ($_REQUEST['bacterie'] as $clade) {
          $req = $bdd->prepare('INSERT INTO CorrespondanceEchantillonBacterie VALUES (:idEchantillon,:clade)');
          $entre['idEchantillon']= $idEchantillon;
          $entre['clade']= $clade;
          $req->execute($entre);
      }
    }



    if ($_REQUEST['nom']=='Valider et ajouter un nouvel échantillon') {
        if (isset($_REQUEST['idGrotte'])) {
            header("Refresh: 0; URL=../ajoutEchantillon.php?nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['codePiege']);
        } else {
            $codePiege = $_REQUEST['codePiege'];

            $requete = "SELECT g.nomcavite, s.idgrotte, s.numsite, s.id
                        FROM Grotte g, Site s
                        WHERE (s.id = (SELECT p.idSite FROM Piege p WHERE p.codePiege = '$codePiege')
                        AND g.id = s.idgrotte)";
            $resultat = requete($bdd, $requete);

            $nomGrotte = $resultat[0]['nomcavite'];
            $idGrotte = $resultat[0]['idgrotte'];
            $numSite = $resultat[0]['numsite'];
            $idSite = $resultat[0]['id'];

            header("Refresh: 0; URL=../ajoutEchantillon.php?nomGrotte=$nomGrotte&idGrotte=$idGrotte&site=$numSite&idSite=$idSite&piege=$codePiege");
        }
    }

    if ($_REQUEST['nom']=='Valider et revenir au tableau des échantillons') {
        header("Refresh: 0; URL=../tableauEchantillon.php?nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['codePiege']);
    }
} else {
    echo "Il y a ".$nombreResultat." Taxonomie correspondante ! ";
}
