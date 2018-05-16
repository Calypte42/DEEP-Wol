<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$id = $_POST['id'];

$requete = "UPDATE Analyses SET resultat=:resultat, type=:type,
    nomGene=:nomGene, dateAnalyse=:dateAnalyse";



// Gestion de date vide
if(empty($_REQUEST['date'])){
    $date=null;
}
else {
  $date=$_REQUEST['date'];
}

$execution = array(
  'type' => $_REQUEST['type'],
  'resultat' => $_REQUEST['resultat'],
  'dateAnalyse' => $date,
  'nomGene' => $_REQUEST['nomGene'],
);

// GESTION DES FASTA
$tmpNameFASTA = $_FILES['fasta']['tmp_name'];

if ($_REQUEST['presenceFasta'] == 'changer') {

    if(file_exists($tmpNameFASTA) || is_uploaded_file($tmpNameFASTA)) {
        $requete .= ", fasta=:fasta ";
        if (!empty($_REQUEST['lienFASTAPrecedent'])) {
            if(file_exists("../" .$_REQUEST['lienFASTAPrecedent'])) {
                unlink("../" . $_REQUEST['lienFASTAPrecedent']);
            }
        }

        $nom = $_FILES['fasta']['name'];

        move_uploaded_file($tmpNameFASTA, "../files/fasta/".$nom);
        $fasta = "files/fasta/" . $nom;

        $execution['fasta'] = $fasta;
    }

} elseif ($_REQUEST['presenceFasta'] == 'supprimer') {
    $requete .= ", fasta=:fasta ";
    $execution['fasta'] = null;
    if (!empty($_REQUEST['lienFASTAPrecedent'])) {
        if(file_exists("../" .$_REQUEST['lienFASTAPrecedent'])) {
            unlink("../" . $_REQUEST['lienFASTAPrecedent']);
        }
    }
}

// GESTION DES Electrophoregramme
$tmpNameElectro = $_FILES['electrophoregramme']['tmp_name'];

if ($_REQUEST['presenceElectrophoregramme'] == 'changer') {
    if(file_exists($tmpNameElectro) || is_uploaded_file($tmpNameElectro)) {
        $requete .= ", electrophoregramme=:electrophoregramme";
        if (!empty($_REQUEST['lienElectroPrecedent'])) {
            if(file_exists("../" .$_REQUEST['lienElectroPrecedent'])) {
                unlink("../" . $_REQUEST['lienElectroPrecedent']);
            }
        }

        $nom = $_FILES['electrophoregramme']['name'];
        move_uploaded_file($tmpNameElectro, "../files/electrophoregramme/".$nom);
        $electrophoregramme = "files/electrophoregramme/" . $nom;

        $execution['electrophoregramme'] = $electrophoregramme;
    }

} elseif ($_REQUEST['presenceElectrophoregramme'] == 'supprimer') {
    $requete .= ", electrophoregramme=:electrophoregramme";
    $execution['electrophoregramme'] = null;
    if (!empty($_REQUEST['lienElectroPrecedent'])) {
        if(file_exists("../" .$_REQUEST['lienElectroPrecedent'])) {
            unlink("../" . $_REQUEST['lienElectroPrecedent']);
        }
    }
}

$requete .= " WHERE id = '$id'";

$req = $bdd->prepare($requete);



$req->execute($execution);

header("Refresh: 0; URL=../tableauAnalyse.php?idEchantillon=".$_REQUEST['idEchantillon']."&numEchantillon=".$_REQUEST['numEchantillon']."&nomGrotte=".$_REQUEST['nomGrotte']."&idGrotte=".$_REQUEST['idGrotte']."&site=".$_REQUEST['site']."&idSite=".$_REQUEST['idSite']."&piege=".$_REQUEST['piege']);


?>
