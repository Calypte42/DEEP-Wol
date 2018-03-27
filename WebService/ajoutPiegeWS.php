<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Piege (codePiege,datePose,heurePose,
  dateRecup,heureRecup,probleme,dateTri,codeEquipeSpeleo,idSite)
    SELECT :codePiege,:datePose,:heurePose,
      :dateRecup,:heureRecup,:probleme,:dateTri,codeEquipe,id FROM EquipeSpeleo, Site
      WHERE numSite = :numSite AND codeEquipe = :codeEquipeSpeleo;');


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
  'dateTri' => $dateTri,
  'numSite' => $_REQUEST['numSite'],
  'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']


));

if ($_REQUEST['nom']=='Valider et ajouter un nouveau piege'){
  header('Refresh: 0; URL=../ajoutPiege.php');
}

if ($_REQUEST['nom']=='Valider et aller à la page suivante'){
  header('Refresh: 0; URL=../ajoutEchantillon.php');
}

echo http_response_code();

?>
