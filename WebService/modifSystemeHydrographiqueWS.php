<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('UPDATE SystemeHydrographique SET nom=:nom, departement=:departement, pays=:pays WHERE id=:id;');
$req->execute(array(
	'nom' => $_REQUEST['nom'],
  'departement' => $_REQUEST['departement'],
  'pays' => $_REQUEST['pays'],
  'id' => $_REQUEST['id']
));

header('Refresh: 0; URL=../recherche.php');

?>
