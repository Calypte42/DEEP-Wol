<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Individu (numIndividu,formeStockage,lieuStockage,
  niveauIdentification,infecteBacterie,codePiege,idAuteur,idTaxonomie)
 SELECT :numIndividu,:formeStockage,:lieuStockage,:niveauIdentification,:infecteBacterie,:codePiege,
  p.id,t.id FROM Taxonomie t, Personne p WHERE t.classe=:classe and t.ordre=:ordre and
    t.famille = :famille and t.sousFamille = : sousFamille and t.genre = :genre and t.espece = :espece and
      p.nom = nomAuteur and p.prenom = prenomAuteur;');
$req->execute(array(

	'numIndividu' => $_REQUEST['numIndividu'],
  'formeStockage' => $_REQUEST['formeStockage'],
  'lieuStockage' => $_REQUEST['lieuStockage'],
  'niveauIdentification' => $_REQUEST['niveauIdentification'],
  'infecteBacterie' => $_REQUEST['infecteBacterie'],
  'codePiege' => $_REQUEST['codePiege'],
  'classe' => $_REQUEST['classe'],
  'ordre' => $_REQUEST['ordre'],
  'famille' => $_REQUEST['famille'],
  'sousFamille' => $_REQUEST['sousFamille'],
  'genre' => $_REQUEST['genre'],
  'espece' => $_REQUEST['espece'],
  'nomAuteur' => $_REQUEST['nomAuteur'],
  'prenomAuteur' => $_REQUEST['prenomAuteur']

));

header('Refresh: 3; URL=ajoutIndividu.php');
echo http_response_code();

?>
