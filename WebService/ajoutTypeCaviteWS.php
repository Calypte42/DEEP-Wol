<?php
//Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Grotte VALUES (:typeCavite);');
$req->execute(array(
	'typeCavite' => $_REQUEST['typeCavite'],
));

echo http_response_code();

?>
