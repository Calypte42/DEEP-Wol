<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare("INSERT INTO Personne (initiale) VALUES (:initiale)");
$req->execute(array(
	'initiale' => $_REQUEST['personne']
));

$last_id = $bdd->lastInsertId();

$bdd = null;

echo $last_id;

?>
