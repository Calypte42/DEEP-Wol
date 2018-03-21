<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille,genre,espece)
  VALUES (:classe,:ordre,:famille,:sousFamille,:genre,:espece);');
$req->execute(array(
	'classe' => $_REQUEST['classeTaxo'],
  'ordre' => $_REQUEST['ordreTaxo'],
  'famille' => $_REQUEST['familleTaxo'],
  'sousFamille' => $_REQUEST['sousFamilleTaxo'],
  'genre' => $_REQUEST['genreTaxo'],
  'espece' => $_REQUEST['especeTaxo'],
  'photo' => $_REQUEST['photo']

));

  header('Refresh: 5; URL=ajoutTaxonomie.php');
