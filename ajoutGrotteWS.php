<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Grotte (nomCavite,typeCavite,latitude,longitude,
  typeAcces,accesPublic,idSystemeHydrographique) SELECT :nomGrotte,:typeCavite,:latitude,
  :longitude,:typeAcces,:accesPublic, id FROM SystemeHydrographique WHERE nom = :systemeHydro;');
$req->execute(array(
	'nomGrotte' => $_REQUEST['nomGrotte'],
  'typeCavite' => $_REQUEST['typeCavite'],
  'latitude' => $_REQUEST['latitude'],
  'longitude' => $_REQUEST['longitude'],
  'typeAcces' => $_REQUEST['typeAcces'],
  'accesPublic' => $_REQUEST['accesPublic'],
  'systemeHydro' => $_REQUEST['systemeHydro']
/* Et on entre par exemple : http://localhost/~aurelien/TER/testBDD.php?nomEquipe=Equipe5 */

));

if ($_REQUEST['nom']=='Valider et ajouter une nouvelle grotte'){
  header('Refresh: 0; URL=ajoutGrotte.php');
}

if ($_REQUEST['nom']=='Valider et aller à la page suivante'){
  header('Refresh: 0; URL=ajoutSite.php');
}

echo http_response_code();

?>
