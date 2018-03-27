<?php

//fonctionnel !

include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Gene VALUES (:nom);');
$req->execute(array(
	'nom' => $_REQUEST['nomGene'],
));

header('Refresh: 0; URL=../ajoutGene.php');
echo http_response_code();

?>
