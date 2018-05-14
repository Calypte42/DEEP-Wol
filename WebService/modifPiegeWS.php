<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$id = $_POST['id'];

$req = $bdd->prepare("UPDATE Piege SET codePiege=:codePiege, datePose=:datePose,
    heurePose=:heurePose, dateRecup=:dateRecup, heureRecup=:heureRecup,
    probleme=:probleme, dateTri=:dateTri, temperature=:temperature, codeEquipeSpeleo=:codeEquipeSpeleo
    WHERE codePiege = '$id'");


// Gestion de datePose vide
if (empty($_REQUEST['datePose'])) {
    $datePose=null;
} else {
    $datePose=$_REQUEST['datePose'];
}

// Gestion de heurePose vide
if (empty($_REQUEST['heurePose'])) {
    $heurePose=null;
} else {
    $heurePose=$_REQUEST['heurePose'];
}

// Gestion de dateRecup vide
if (empty($_REQUEST['dateRecup'])) {
    $dateRecup=null;
} else {
    $dateRecup=$_REQUEST['dateRecup'];
}

// Gestion de heureRecup vide
if (empty($_REQUEST['heureRecup'])) {
    $heureRecup=null;
} else {
    $heureRecup=$_REQUEST['heureRecup'];
}

// Gestion de probleme vide
if (empty($_REQUEST['probleme'])) {
    $probleme=null;
} else {
    $probleme=$_REQUEST['probleme'];
}

// Gestion de temperature vide
if (empty($_REQUEST['temperature'])) {
    $temperature=null;
} else {
    $temperature=$_REQUEST['temperature'];
}

// Gestion de dateTri vide
if (empty($_REQUEST['dateTri'])) {
    $dateTri=null;
} else {
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
  'temperature' => $temperature,
  'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']
));

header("Refresh: 0; URL=../tableauPiege.php?nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']);

?>
