<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Echantillon VALUES (:formeStockage);');
$req->execute(array(
	'formeStockage' => $_REQUEST['formeStockage']

/* Et on entre par exemple : http://localhost/~aurelien/TER/testBDD.php?nomEquipe=Equipe5 */

));

echo http_response_code();

?>
