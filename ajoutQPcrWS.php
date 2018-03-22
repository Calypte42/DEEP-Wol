<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO qPCR (resultat,dateqPCR,fasta,electrophoregramme,idIndividu,nomGene)
 SELECT :resultat,:dateqPCR,:fasta,:electrophoregramme,id,nom
  FROM Individu,Gene WHERE nom = :nomGene and numIndividu=:numIndividu;');
$req->execute(array(
	'resultat' => $_REQUEST['resultat'],
  'dateqPCR' => $_REQUEST['dateqPCR'],
  'fasta' => $_REQUEST['fasta'],
  'electrophoregramme' => $_REQUEST['electrophoregramme'],
  'nomGene' => $_REQUEST['nomGene'],
  'numIndividu' => $_REQUEST['numIndividu'],

));


echo http_response_code();

?>
