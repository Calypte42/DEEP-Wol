<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$requete='INSERT INTO Analyses (type,resultat,dateanalyse,fasta,electrophoregramme,idEchantillon,nomGene)
   SELECT :type,:resultat,:dateAnalyse,:fasta,:electrophoregramme,:idEchantillon,nom
    FROM Gene WHERE nom = :nomGene;';


$req = $bdd->prepare($requete);

// Gestion de date vide
if(empty($_REQUEST['date'])){
    $date=null;
}
else {
  $date=$_REQUEST['date'];
}

// GESTION DES FASTA
$tmpNameFASTA = $_FILES['fasta']['tmp_name'];

if(file_exists($tmpNameFASTA) || is_uploaded_file($tmpNameFASTA)) {
    $nom = $_FILES['fasta']['name'];

    /*if (preg_match("#.fasta$#i", $nom)) {
        $n = $_REQUEST['idEchantillon'] . "_" . $_REQUEST['nomGene'] . "_" . $date . ".fasta";
        move_uploaded_file($tmpNameFASTA, "../files/fasta/".$n);
        $fasta = "files/fasta/" . $n;
    } else {
        $fasta=null;
    }*/

    move_uploaded_file($tmpNameFASTA, "../files/fasta/".$nom);
    $fasta = "files/fasta/" . $nom;

} else {
  $fasta=null;
}

// GESTION DES Electrophoregramme
$tmpNameElectro = $_FILES['electrophoregramme']['tmp_name'];

if(file_exists($tmpNameElectro) || is_uploaded_file($tmpNameElectro)) {
    /*$check = getimagesize($tmpNameElectro);
    if ($check) {
        $path_parts = pathinfo($_FILES["electrophoregramme"]["name"]);
        $extension = $path_parts['extension'];
        $n = $_REQUEST['idEchantillon'] . "_" . $_REQUEST['nomGene'] . "_" . $date . ".".$extension;
        move_uploaded_file($tmpNameElectro, "../files/electrophoregramme/".$n);
        $electrophoregramme = "files/electrophoregramme/" . $n;
    } else {
        $electrophoregramme=null;
    }*/

    $nom = $_FILES['electrophoregramme']['name'];
    move_uploaded_file($tmpNameElectro, "../files/electrophoregramme/".$nom);
    $electrophoregramme = "files/electrophoregramme/" . $nom;

} else {
  $electrophoregramme=null;
}

echo $fasta;
echo $electrophoregramme;


$req->execute(array(
  'type' => $_REQUEST['type'],
  'resultat' => $_REQUEST['resultat'],
  'dateAnalyse' => $date,
  'fasta' => $fasta,
  'electrophoregramme' => $electrophoregramme,
  'nomGene' => $_REQUEST['nomGene'],
  'idEchantillon' => $_REQUEST['idEchantillon'],

));

if ($_REQUEST['nom']=='Valider et ajouter une nouvelle analyse'){
  header("Refresh: 0; URL=../ajoutAnalyse.php?idEchantillon=".$_REQUEST['idEchantillon']."&numEchantillon=".$_REQUEST['numEchantillon']."&nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['piege']);
}

if ($_REQUEST['nom']=='Valider et revenir au tableau des analyses'){
  header("Refresh: 0; URL=../tableauAnalyse.php?idEchantillon=".$_REQUEST['idEchantillon']."&numEchantillon=".$_REQUEST['numEchantillon']."&nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['piege']);
}

echo http_response_code();

?>
