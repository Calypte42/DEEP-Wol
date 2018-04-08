<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Site (profondeur,temperature,typeSol,numSite,distanceEntree,
  presenceEau, idGrotte, codeEquipeSpeleo)
    SELECT :profondeur,:temperature,:typeSol,:numSite,:distanceEntree,
    :presenceEau, :idGrotte, codeEquipe FROM EquipeSpeleo
      WHERE codeEquipe = :codeEquipeSpeleo;');

// Gestion de profondeur vide
if(empty($_REQUEST['profondeur'])){
    $profondeur=null;
}
else {
  $profondeur=$_REQUEST['profondeur'];
}

// Gestion de temperature vide
if(empty($_REQUEST['temperature'])){
  $temperature=null;
}
else {
    $temperature=$_REQUEST['temperature'];
}

// Gestion de typeSol vide
if(empty($_REQUEST['typeSol'])){
  $typeSol=null;
}
else {
    $TypeSol=$_REQUEST['typeSol'];
}

// Gestion de presenceEau non coche
if(isset($_REQUEST['presenceEau'])){
  $presenceEau=$_REQUEST['presenceEau'];
}
else {
  $presenceEau=null;
}


$req->execute(array(
	'profondeur' => $profondeur,
  'temperature' => $temperature,
  'typeSol' => $typeSol,
  'numSite' => $_REQUEST['numSite'],
  'distanceEntree' => $_REQUEST['distanceEntree'],
  'presenceEau' => $presenceEau,
  'idGrotte' => $_REQUEST['idGrotte'],
  'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']

));

$idSite=$bdd->lastInsertId(); //recuper l'id de l element inserer.

if ($_REQUEST['nom']=='Valider et ajouter un nouveau site'){
  header("Refresh: 0; URL=../ajoutSite.php?idGrotte=".$_REQUEST['idGrotte']."&grotte=".$_REQUEST['grotte']);
}

if ($_REQUEST['nom']=='Valider et ajouter un nouveau piege'){
  header("Refresh:0; URL=../ajoutPiege.php?idGrotte=".$_REQUEST['idGrotte']."&nomGrotte=".$_REQUEST['grotte']."&idSite=$idSite&site=".$_REQUEST['numSite']);
}

if ($_REQUEST['nom']=='Valider et revenir au tableau'){
  header("Refresh: 0; URL=../tableauSite.php?idGrotte=".$_REQUEST['idGrotte']."&grotte=".$_REQUEST['grotte']);
}

echo http_response_code();

?>
