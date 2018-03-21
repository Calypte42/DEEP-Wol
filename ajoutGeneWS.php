<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Gene VALUES (:nom);');
$req->execute(array(
	'nom' => $_REQUEST['nom'],
));

echo http_response_code();

?>
