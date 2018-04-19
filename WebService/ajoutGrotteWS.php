<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Grotte (nomCavite,typeCavite,latitude,longitude,
  typeAcces,accesPublic,idSystemeHydrographique) SELECT :nomGrotte,:typeCavite,:latitude,
  :longitude,:typeAcces,:accesPublic, id FROM SystemeHydrographique WHERE nom = :systemeHydro;');

  if(isset($_REQUEST['accesPublic'])){
    $accesPublic=$_REQUEST['accesPublic'];
  }
  else {
    $accesPublic=null;
  }

$req->execute(array(
	'nomGrotte' => $_REQUEST['nomGrotte'],
  'typeCavite' => $_REQUEST['typeCavite'],
  'latitude' => $_REQUEST['latitude'],
  'longitude' => $_REQUEST['longitude'],
  'typeAcces' => $_REQUEST['typeAcces'],
  'accesPublic' => $accesPublic,
  'systemeHydro' => $_REQUEST['systemeHydro']

));

$idGrotte=$bdd->lastInsertId(); //recuper l'id de l element inserer.

if ($_REQUEST['nom']=='Valider et ajouter une nouvelle grotte'){
  header('Refresh: 0; URL=../ajoutGrotte.php');
}

if ($_REQUEST['nom']=='Valider et ajouter un site'){
  header("Refresh: 0; URL=../ajoutSite.php?idGrotte=$idGrotte&grotte=".$_REQUEST['nomGrotte']);
}

if ($_REQUEST['nom']=='Valider et revenir au tableau des grottes'){
  header('Refresh: 0; URL=../tableauGrotte.php');
}

echo http_response_code();

?>
