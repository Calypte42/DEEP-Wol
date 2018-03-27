<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Pool VALUES (:identifiant);');
$req->execute(array(
	'identifiant' => $_REQUEST['identifiant'],
));


echo http_response_code();

?>
