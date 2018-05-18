<?php

//fonctionnel !

include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('UPDATE Gene SET nom=:nom WHERE nom=:id');
$req->execute(array(
	'nom' => $_REQUEST['nomGene'],
    'id' => $_REQUEST['id']
));

header('Refresh: 0; URL=../recherche.php');

?>
