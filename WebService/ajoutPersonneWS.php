<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Personne VALUES (:nom,:prenom);');
$req->execute(array(
	'nom' => $_REQUEST['prenom'],
  'prenom' => $_REQUEST['prenom'],
));

echo http_response_code();

?>
