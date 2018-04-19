<?php

//fonctionnel !

include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('UPDATE Gene SET nom=:nom;');
$req->execute(array(
	'nom' => $_REQUEST['nomGene'],
));

header('Refresh: 0; URL=../ajoutGene.php');
echo http_response_code();

?>
