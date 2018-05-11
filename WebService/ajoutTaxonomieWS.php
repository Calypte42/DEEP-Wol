<?php
// ne fonctionne pas avec les photos pour le moments
include '../BDD/bdd.php';
$bdd = connexionbd();

// GESTION DES PHOTO
if(isset($_FILES['photo']['tmp_name'])){
  $tmpNamePHOTO = $_FILES['photo']['tmp_name'];

  if(file_exists($tmpNamePHOTO) || is_uploaded_file($tmpNamePHOTO)) {
      $nom = $_FILES['photo']['name'];

      move_uploaded_file($tmpNamePHOTO, "../files/photo/".$nom);
      $photo = "files/photo/" . $nom;

} else {
  $photo=null;
}}else{
  $photo=null;
}

$req = $bdd->prepare('INSERT INTO Taxonomie (classe,ordre,famille,sousFamille,genre,espece,photo) VALUES (:classe,:ordre,:famille,:sousFamille,:genre,:espece,:photo);');

if(!empty($_REQUEST['classeTaxo'])){
  $req->execute(array(
    'classe' => $_REQUEST['classeTaxo'],
    'ordre' => '',
    'famille' => '',
    'sousFamille' => '',
    'genre' =>'' ,
    'espece' => '',
    'photo' => $photo,
  ));
  if(!empty($_REQUEST['ordreTaxo'])){
    $req->execute(array(
      'classe' => $_REQUEST['classeTaxo'],
      'ordre' => $_REQUEST['ordreTaxo'],
      'famille' =>'' ,
      'sousFamille' => '',
      'genre' => '',
      'espece' => '',
      'photo' => $photo,
    ));
    if(!empty($_REQUEST['familleTaxo'])){
      $req->execute(array(
        'classe' => $_REQUEST['classeTaxo'],
        'ordre' => $_REQUEST['ordreTaxo'],
        'famille' => $_REQUEST['familleTaxo'],
        'sousFamille' => '',
        'genre' => '',
        'espece' => '',
        'photo' => $photo,
      ));
      if(!empty($_REQUEST['sousFamilleTaxo'])){
        $req->execute(array(
          'classe' => $_REQUEST['classeTaxo'],
          'ordre' => $_REQUEST['ordreTaxo'],
          'famille' => $_REQUEST['familleTaxo'],
          'sousFamille' => $_REQUEST['sousFamilleTaxo'],
          'genre' => '',
          'espece' =>'' ,
          'photo' => $photo,
        ));
        if(!empty($_REQUEST['genreTaxo'])){
          $req->execute(array(
            'classe' => $_REQUEST['classeTaxo'],
            'ordre' => $_REQUEST['ordreTaxo'],
            'famille' => $_REQUEST['familleTaxo'],
            'sousFamille' => $_REQUEST['sousFamilleTaxo'],
            'genre' => $_REQUEST['genreTaxo'],
            'espece' => '',
            'photo' => $photo,
          ));
          if(!empty($_REQUEST['especeTaxo'])){
            $req->execute(array(
              'classe' => $_REQUEST['classeTaxo'],
              'ordre' => $_REQUEST['ordreTaxo'],
              'famille' => $_REQUEST['familleTaxo'],
              'sousFamille' => $_REQUEST['sousFamilleTaxo'],
              'genre' => $_REQUEST['genreTaxo'],
              'espece' => $_REQUEST['especeTaxo'],
              'photo' => $photo,

            ));

          }}}}}}


header('Refresh: 5; URL=../ajoutTaxonomie.php');
