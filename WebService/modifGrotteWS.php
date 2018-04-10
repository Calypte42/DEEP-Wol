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

$req->execute(array(
    'nomGrotte' => $_REQUEST['nomGrotte'],
    'typeCavite' => $_REQUEST['typeCavite'],
    'latitude' => $_REQUEST['latitude'],
    'longitude' => $_REQUEST['longitude'],
    'typeAcces' => $_REQUEST['typeAcces'],
    'accesPublic' => $accesPublic,
    'idSystemeHydrographique' => $_REQUEST['systemeHydro']
));

header('Refresh: 0; URL=../tableauGrotte.php');

echo http_response_code();


?>
