<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$id = $_POST['id'];

$req = $bdd->prepare("UPDATE Site SET profondeur=:profondeur,
    typeSol=:typeSol, numSite=:numSite, distanceEntree=:distanceEntree,
    presenceEau=:presenceEau, codeEquipeSpeleo=:codeEquipeSpeleo WHERE id=$id");

// Gestion de profondeur vide
if (empty($_REQUEST['profondeur'])) {
    $profondeur=null;
} else {
    $profondeur=$_REQUEST['profondeur'];
}

if ($_REQUEST['typeSol'] == 'autre') {
    $typeSol=$_REQUEST['autreSol'];
} else {
    $typeSol=$_REQUEST['typeSol'];
}

// Gestion de presenceEau non coche
if(isset($_REQUEST['presenceEau'])){
  if($_REQUEST['presenceEau']!="null"){
    $presenceEau=$_REQUEST['presenceEau'];
  }
  else{$presenceEau=null;}
}
else {
  $presenceEau=null;
}


$req->execute(array(
  'profondeur' => $profondeur,
  'typeSol' => $typeSol,
  'numSite' => $_REQUEST['numSite'],
  'distanceEntree' => $_REQUEST['distanceEntree'],
  'presenceEau' => $presenceEau,
  'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']

));

header("Refresh: 0; URL=../tableauSite.php?idGrotte=".$_REQUEST['idGrotte']."&grotte=".$_REQUEST['grotte']);

?>
