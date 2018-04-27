<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Piege (codePiege,datePose,heurePose,
  dateRecup,heureRecup,temperature,probleme,dateTri,idSite,codeEquipeSpeleo)
    SELECT :codePiege,:datePose,:heurePose,
      :dateRecup,:heureRecup,:temperature,:probleme,:dateTri,:id,codeEquipe FROM EquipeSpeleo
      WHERE codeEquipe = :codeEquipeSpeleo;');


// Gestion de datePose vide
if(empty($_REQUEST['datePose'])){
    $datePose=null;
}
else {
  $datePose=$_REQUEST['datePose'];
}

// Gestion de heurePose vide
if(empty($_REQUEST['heurePose'])){
    $heurePose=null;
}
else {
  $heurePose=$_REQUEST['heurePose'];
}

// Gestion de dateRecup vide
if(empty($_REQUEST['dateRecup'])){
    $dateRecup=null;
}
else {
  $dateRecup=$_REQUEST['dateRecup'];
}

// Gestion de heureRecup vide
if(empty($_REQUEST['heureRecup'])){
    $heureRecup=null;
}
else {
  $heureRecup=$_REQUEST['heureRecup'];
}

// Gestion de probleme vide
if(empty($_REQUEST['probleme'])){
    $probleme=null;
}
else {
  $probleme=$_REQUEST['probleme'];
}

// Gestion de temperature vide
if(empty($_REQUEST['temperature'])){
  $temperature=null;
}
else {
    $temperature=$_REQUEST['temperature'];
}

// Gestion de dateTri vide
if(empty($_REQUEST['dateTri'])){
    $dateTri=null;
}
else {
  $dateTri=$_REQUEST['dateTri'];
}
$req->execute(array(
	'codePiege' => $_REQUEST['codePiege'],
  'datePose' => $datePose,
  'heurePose' => $heurePose,
  'dateRecup' => $dateRecup,
  'heureRecup' => $heureRecup,
  'probleme' => $probleme,
  'temperature'=>$temperature,
  'dateTri' => $dateTri,
  'id' => $_REQUEST['idSite'],
  'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']


));

if ($_REQUEST['nom']=='Valider et ajouter un nouveau piège'){
  header("Refresh: 0; URL=../ajoutPiege.php?nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']);
}

if ($_REQUEST['nom']=='Valider et ajouter un nouvel échantillon'){
  header("Refresh: 0; URL=../ajoutEchantillon.php?nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['codePiege']);
}

if ($_REQUEST['nom']=='Valider et revenir au tableau des pièges'){
  header("Refresh: 5; URL=../tableauPiege.php?nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']);
}

echo http_response_code();

?>
