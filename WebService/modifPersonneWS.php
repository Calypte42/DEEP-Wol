<?php

//fonctionnel !

include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('UPDATE Personne SET initiale=:nomPersonne WHERE id=:id;');
$req->execute(array(
	'nomPersonne' => $_REQUEST['nomPersonne'],
    'id' => $_REQUEST['id']
));

header('Refresh: 0; URL=../recherche.php');

?>
