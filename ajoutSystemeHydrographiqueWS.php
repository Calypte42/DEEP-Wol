<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO SystemeHydrographique (nom,departement)
VALUES (:nom,:departement);');
$req->execute(array(
	'nom' => $_REQUEST['nom'],
  'departement' => $_REQUEST['departement']

/* Et on entre par exemple : http://localhost/~aurelien/TER/testBDD.php?nomEquipe=Equipe5 */

));

echo http_response_code();

?>
