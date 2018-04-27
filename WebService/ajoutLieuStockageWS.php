<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Echantillon VALUES (:lieuStockage);');
$req->execute(array(
	'lieuStockage' => $_REQUEST['lieuStockage']

/* Et on entre par exemple : http://localhost/~aurelien/TER/testBDD.php?nomEquipe=Equipe5 */

));

echo http_response_code();

?>
