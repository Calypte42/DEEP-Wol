<?php
// ne fonctionne pas avec les photos pour le moments
include '../BDD/bdd.php';
$bdd = connexionbd();

if(!empty($_REQUEST['classeTaxo'])){
  $req = $bdd->prepare('INSERT INTO Taxonomie (classe)
    VALUES (:classe);');
  $req->execute(array(
  	'classe' => $_REQUEST['classeTaxo'],
  ));
  if(!empty($_REQUEST['ordreTaxo'])){
    $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre)
      VALUES (:classe,:ordre);');
    $req->execute(array(
    	'classe' => $_REQUEST['classeTaxo'],
      'ordre' => $_REQUEST['ordreTaxo'],
    ));
    if(!empty($_REQUEST['familleTaxo'])){
      $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille)
        VALUES (:classe,:ordre,:famille);');
      $req->execute(array(
        'classe' => $_REQUEST['classeTaxo'],
        'ordre' => $_REQUEST['ordreTaxo'],
        'famille' => $_REQUEST['familleTaxo'],
      ));
      if(!empty($_REQUEST['sousFamilleTaxo'])){
        $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille)
          VALUES (:classe,:ordre,:famille,:sousFamille);');
        $req->execute(array(
          'classe' => $_REQUEST['classeTaxo'],
          'ordre' => $_REQUEST['ordreTaxo'],
          'famille' => $_REQUEST['familleTaxo'],
          'sousFamille' => $_REQUEST['sousFamilleTaxo'],
        ));
        if(!empty($_REQUEST['genreTaxo'])){
          $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille,genre)
            VALUES (:classe,:ordre,:famille,:sousFamille,:genre);');
          $req->execute(array(
            'classe' => $_REQUEST['classeTaxo'],
            'ordre' => $_REQUEST['ordreTaxo'],
            'famille' => $_REQUEST['familleTaxo'],
            'sousFamille' => $_REQUEST['sousFamilleTaxo'],
            'genre' => $_REQUEST['genreTaxo'],
          ));
            if(!empty($_REQUEST['especeTaxo'])){
              $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille,genre,espece)
                VALUES (:classe,:ordre,:famille,:sousFamille,:genre,:espece);');
              $req->execute(array(
              	'classe' => $_REQUEST['classeTaxo'],
                'ordre' => $_REQUEST['ordreTaxo'],
                'famille' => $_REQUEST['familleTaxo'],
                'sousFamille' => $_REQUEST['sousFamilleTaxo'],
                'genre' => $_REQUEST['genreTaxo'],
                'espece' => $_REQUEST['especeTaxo'],
                //'photo' => $_REQUEST['photo']

              ));

}}}}}}



  header('Refresh: 10; URL=../ajoutTaxonomie.php');
