<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO PCR (resultat,datePCR,fasta,electrophoregramme,idIndividu,nomGene)
 SELECT :resultat,:datePCR,:fasta,:electrophoregramme,id,nom
  FROM Individu,Gene WHERE nom = :nomGene and numIndividu=:numIndividu;');
$req->execute(array(
	'resultat' => $_REQUEST['resultat'],
  'datePCR' => $_REQUEST['datePCR'],
  'fasta' => $_REQUEST['fasta'],
  'electrophoregramme' => $_REQUEST['electrophoregramme'],
  'nomGene' => $_REQUEST['nomGene'],
  'numIndividu' => $_REQUEST['numIndividu'],

));


echo http_response_code();

?>
