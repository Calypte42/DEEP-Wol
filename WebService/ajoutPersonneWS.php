<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Personne VALUES (:initiale);');
$req->execute(array(
	'initiale' => $_REQUEST['initialeAuteur']
));

echo http_response_code();

?>
