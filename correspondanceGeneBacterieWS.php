<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO CorrespondanceGeneBacterie (nomGene,clade)
  SELECT nom,clade FROM Gene,Bacterie WHERE nom = :nomGene AND clade=:clade;');
$req->execute(array(
	'nomGene' => $_REQUEST['nomGene'],
  'clade' => $_REQUEST['clade']
));


echo http_response_code();

?>
