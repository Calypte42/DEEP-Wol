<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$id = $_POST['id'];

$req = $bdd->prepare("UPDATE Grotte SET nomCavite=:nomGrotte, typeCavite=:typeCavite,
    latitude=:latitude, longitude=:longitude, typeAcces=:typeAcces,
    accesPublic=:accesPublic, idSystemeHydrographique=:idSystemeHydrographique WHERE id=$id");

if(isset($_REQUEST['accesPublic'])){
    $accesPublic=$_REQUEST['accesPublic'];
} else {
    $accesPublic=null;
}

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
} elseif ($_REQUEST['typeCavite'] == "Indéterminé") {
    $typeCavite = null;
} else {
    $typeCavite = $_REQUEST['typeCavite'];
}

if ($_REQUEST['typeAcces'] == 'autre') {
    $typeAcces = $_REQUEST['autreTypeAcces'];
} elseif ($_REQUEST['typeAcces'] == 'Indéterminé') {
    $typeAcces = null;
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
    'idSystemeHydrographique' => $_REQUEST['systemeHydro']
));

header('Refresh: 0; URL=../tableauGrotte.php');

?>
