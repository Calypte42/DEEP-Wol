<?php
// ne fonctionne pas avec les photos pour le moments
include '../BDD/bdd.php';
$bdd = connexionbd();
if(!empty($_REQUEST['classeTaxo'])){
  $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille,genre,espece)
  VALUES (:classe,:ordre,:famille,:sousFamille,:genre,:espece);');
  $req->execute(array(
    'classe' => $_REQUEST['classeTaxo'],
    'ordre' => "",
    'famille' => "",
    'sousFamille' => "",
    'genre' =>"" ,
    'espece' => "",
  ));
  if(!empty($_REQUEST['ordreTaxo'])){
    $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille,genre,espece)
    VALUES (:classe,:ordre,:famille,:sousFamille,:genre,:espece);');
    $req->execute(array(
      'classe' => $_REQUEST['classeTaxo'],
      'ordre' => $_REQUEST['ordreTaxo'],
      'famille' =>"" ,
      'sousFamille' => "",
      'genre' => "",
      'espece' => "",
    ));
    if(!empty($_REQUEST['familleTaxo'])){
      $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille,genre,espece)
      VALUES (:classe,:ordre,:famille,:sousFamille,:genre,:espece);');
      $req->execute(array(
        'classe' => $_REQUEST['classeTaxo'],
        'ordre' => $_REQUEST['ordreTaxo'],
        'famille' => $_REQUEST['familleTaxo'],
        'sousFamille' => "",
        'genre' => "",
        'espece' => "",
      ));
      if(!empty($_REQUEST['sousFamilleTaxo'])){
        $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille,genre,espece)
        VALUES (:classe,:ordre,:famille,:sousFamille,:genre,:espece);');
        $req->execute(array(
          'classe' => $_REQUEST['classeTaxo'],
          'ordre' => $_REQUEST['ordreTaxo'],
          'famille' => $_REQUEST['familleTaxo'],
          'sousFamille' => $_REQUEST['sousFamilleTaxo'],
          'genre' => "",
          'espece' =>"" ,
        ));
        if(!empty($_REQUEST['genreTaxo'])){
          $req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille,genre,espece)
          VALUES (:classe,:ordre,:famille,:sousFamille,:genre,:espece);');
          $req->execute(array(
            'classe' => $_REQUEST['classeTaxo'],
            'ordre' => $_REQUEST['ordreTaxo'],
            'famille' => $_REQUEST['familleTaxo'],
            'sousFamille' => $_REQUEST['sousFamilleTaxo'],
            'genre' => $_REQUEST['genreTaxo'],
            'espece' => "",
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



          header('Refresh: 0; URL=../ajoutTaxonomie.php');
