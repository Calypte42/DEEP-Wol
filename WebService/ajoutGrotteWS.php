<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();


$req = $bdd->prepare('INSERT INTO Grotte (nomCavite,typeCavite,latitude,longitude,
    typeAcces,accesPublic,idSystemeHydrographique)
        SELECT :nomGrotte,:typeCavite,:latitude, :longitude,:typeAcces,:accesPublic, id
            FROM SystemeHydrographique
                WHERE id = :systemeHydro;');

if (isset($_REQUEST['longitude1'])&&!empty($_REQUEST['longitude1'])) {
    $longitude=$_REQUEST['longitude1']."°";
    if (!empty($_REQUEST['longitude2'])) {
        $longitude=$longitude.$_REQUEST['longitude2']."'";
        if (!empty($_REQUEST['longitude3'])) {
            $longitude=$longitude.$_REQUEST['longitude3'].'"';
        }
    }
    $longitude=$longitude." ".$_REQUEST['orientationLongitude'];
} else {
    $longitude=null;
}

if (isset($_REQUEST['latitude1'])&&!empty($_REQUEST['latitude1'])) {
    $latitude=$_REQUEST['latitude1']."°";
    if (!empty($_REQUEST['latitude2'])) {
        $latitude=$latitude.$_REQUEST['latitude2']."'";
        if (!empty($_REQUEST['latitude3'])) {
            $latitude=$latitude.$_REQUEST['latitude3'].'"';
        }
    }
    $latitude=$latitude." ".$_REQUEST['orientationLatitude'];
} else {
    $latitude=null;
}

if ($_REQUEST['typeCavite'] == 'autre') {
    $typeCavite = $_REQUEST['autreCavite'];
} else {
    $typeCavite = $_REQUEST['typeCavite'];
}

if ($_REQUEST['typeAcces'] == 'autre') {
    $typeAcces = $_REQUEST['autreTypeAcces'];
} else {
    $typeAcces = $_REQUEST['typeAcces'];
}

if ($_REQUEST['accesPublic'] == "NULL") {
    $accesPublic=null;
} else {
    $accesPublic=$_REQUEST['accesPublic'];
}

$req->execute(array(
    'nomGrotte' => $_REQUEST['nomGrotte'],
    'typeCavite' => $typeCavite,
    'latitude' => $latitude,
    'longitude' => $longitude,
    'typeAcces' => $typeAcces,
    'accesPublic' => $accesPublic,
    'systemeHydro' => $_REQUEST['systemeHydro']

));

$idGrotte=$bdd->lastInsertId(); //recuper l'id de l element inserer.

if ($_REQUEST['nom']=='Valider et ajouter une nouvelle grotte') {
    header('Refresh: 0; URL=../ajoutGrotte.php');
}

if ($_REQUEST['nom']=='Valider et ajouter un site') {
    header("Refresh: 0; URL=../ajoutSite.php?idGrotte=$idGrotte&grotte=".$_REQUEST['nomGrotte']);
}

if ($_REQUEST['nom']=='Valider et revenir au tableau des grottes') {
    header('Refresh: 0; URL=../tableauGrotte.php');
}
