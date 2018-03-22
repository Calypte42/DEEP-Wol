<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO PoolIn (idIndividu, identifiantPool
  SELECT id,identifiant FROM Individu,Pool
    WHERE numIndividu = :numIndividu AND identifiant = :identifiant;');
$req->execute(array(
	'numIndividu' => $_REQUEST['numIndividu'],
  'identifiant' => $_REQUEST['identifiant']


echo http_response_code();

?>
