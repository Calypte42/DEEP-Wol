<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$requete="";
if($_REQUEST['choixType']=='qPCR'){
  $requete='INSERT INTO qPCR (resultat,dateqPCR,fasta,electrophoregramme,idEchantillon,nomGene)
   SELECT :resultat,:dateAnalyse,:fasta,:electrophoregramme,:idEchantillon,nom
    FROM Gene WHERE nom = :nomGene;';
}
else {
  $requete='INSERT INTO PCR (resultat,datePCR,fasta,electrophoregramme,idEchantillon,nomGene)
   SELECT :resultat,:dateAnalyse,:fasta,:electrophoregramme,:idEchantillon,nom
    FROM Gene WHERE nom = :nomGene;';
}

$req = $bdd->prepare($requete);

// Gestion de date vide
if(empty($_REQUEST['date'])){
    $date=null;
}
else {
  $date=$_REQUEST['date'];
}

// GESTION DES FASTA
if($_FILES['fasta']){
    $nom = $_FILES['fasta']['name'];

    if (preg_match("#.fasta$#i", $nom)) {
        $n = $_REQUEST['numEchantillon'] . "_" . $_REQUEST['nomGene'] . "_" . $date . ".fasta";
        move_uploaded_file($_FILES['fasta']['tmp_name'], "../files/".$n);
        $fasta = "files/" . $n;
    } else {
        $fasta=null;
    }

} else {
  $fasta=null;
}

// GESTION DES Electrophoregramme
if($_FILES['electrophoregramme']){
    $electrophoregramme=null;
} else {
  $electrophoregramme=null;
}


$req->execute(array(
	'resultat' => $_REQUEST['resultat'],
  'dateAnalyse' => $date,
  'fasta' => $fasta,
  'electrophoregramme' => $electrophoregramme,
  'nomGene' => $_REQUEST['nomGene'],
  'idEchantillon' => $_REQUEST['idEchantillon'],

));

if ($_REQUEST['nom']=='Valider et ajouter une nouvelle analyse'){
  //header("Refresh: 0; URL=../ajoutAnalyse.php?idEchantillon=".$_REQUEST['idEchantillon']."&numEchantillon=".$_REQUEST['numEchantillon']."&nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['piege']);
}

if ($_REQUEST['nom']=='Valider et revenir au tableau des analyses'){
  //header("Refresh: 5; URL=../tableauAnalyse.php?idEchantillon=".$_REQUEST['idEchantillon']."&numEchantillon=".$_REQUEST['numEchantillon']."&nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['piege']);
}

echo http_response_code();

?>
