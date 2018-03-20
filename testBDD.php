<?php
include 'bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO EquipeSpeleo VALUES (:nomEquipe);');
$req->execute(array(
	'nomEquipe' => $_REQUEST['nomEquipe'],
/* Et on entre par exemple : http://localhost/~aurelien/TER/testBDD.php?nomEquipe=Equipe5 */

));

echo http_response_code();

?>
