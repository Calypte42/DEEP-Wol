<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

if($_REQUEST['extraire']=='Telecharger CSV'){
// Paramétrage de l'écriture du futur fichier CSV
$chemin = './fichierTest.csv';
$fichier = 'fichierTest.csv';
$delimiteur = ','; // Pour une tabulation, utiliser $delimiteur = "t";


$enTete[]=array();
$listeSelect="";
$listeWhere=" WHERE 1=1 AND ";

// On prepare la commande select avec les valeurs recuperer par les checkbox

foreach ($_REQUEST['listeItem'] as $key) {
  $listeSelect=$listeSelect.$key.',';
  $enTete[0][]=$key; // On insere le nom de la table dans le tableau permettant d afficher le nom des colonnes dans le csv.
}
$listeSelect=rtrim($listeSelect,',');



// Preparation de la clause WHERE :

if(!empty($_REQUEST['grotte'][0])){
  foreach ($_REQUEST['grotte'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'nomCavite=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR '); // Permet d'enlever OR a la fin de la chaine.
  $listeWhere=$listeWhere.' AND ';
}

if(!empty($_REQUEST['site'][0])){
  foreach ($_REQUEST['site'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'numSite=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR ');
  $listeWhere=$listeWhere.' AND ';
}

if(!empty($_REQUEST['piege'][0])){
  foreach ($_REQUEST['piege'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'codePiege=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR ');
  $listeWhere=$listeWhere.' AND ';
}

if(!empty($_REQUEST['echantillon'][0])){
  foreach ($_REQUEST['echantillon'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'numEchantillon=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR ');
  $listeWhere=$listeWhere.' AND ';
}

if(!empty($_REQUEST['classe'][0])){
  foreach ($_REQUEST['classe'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'classe=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR ');
  $listeWhere=$listeWhere.' AND ';
}

if(!empty($_REQUEST['ordre'][0])){
  foreach ($_REQUEST['ordre'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'ordre=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR ');
  $listeWhere=$listeWhere.' AND ';
}

if(!empty($_REQUEST['famille'][0])){
  foreach ($_REQUEST['famille'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'famille=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR ');
  $listeWhere=$listeWhere.' AND ';
}

if(!empty($_REQUEST['sousFamille'][0])){
  foreach ($_REQUEST['sousFamille'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'sousFamille=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR ');
  $listeWhere=$listeWhere.' AND ';
}

if(!empty($_REQUEST['genre'][0])){
  foreach ($_REQUEST['genre'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'genre=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR ');
  $listeWhere=$listeWhere.' AND ';
}

if(!empty($_REQUEST['espece'][0])){
  foreach ($_REQUEST['espece'] as $key) {
    if(!empty($key)){
    $listeWhere=$listeWhere.'espece=\''.$key.'\' OR ';
    }
  }
  $listeWhere=rtrim($listeWhere,' OR ');
  $listeWhere=$listeWhere.' AND ';
}

$listeWhere=rtrim($listeWhere,' AND ');


// Permet de donner un nom au colonne dans le fichier csv. A revoir.


// Création du fichier csv (le fichier est vide pour le moment)
// w+ : consulter http://php.net/manual/fr/function.fopen.php
$fichier_csv = fopen($fichier, 'w+');

// Si votre fichier a vocation a être importé dans Excel,
// vous devez impérativement utiliser la ligne ci-dessous pour corriger
// les problèmes d'affichage des caractères internationaux (les accents par exemple)
fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));

// On ajoute les en tete des colonnes
foreach ($enTete as $ligne) {
fputcsv($fichier_csv, $ligne, $delimiteur);
}

$requete='SELECT '.$listeSelect.' from V_Echantillon_AvecTaxo '.$listeWhere;
//echo "$requete";
$value=requete($bdd,$requete); /* value recupere la reponse de la requete */


foreach ($value as $ligne) { /* On parcourt le tableau de tableau */
    // chaque ligne en cours de lecture est insérée dans le fichier
  	// les valeurs présentes dans chaque ligne seront séparées par $delimiteur
  	fputcsv($fichier_csv, $ligne, $delimiteur);
}

// fermeture du fichier csv
fclose($fichier_csv);
/*
header('Content-disposition: attachment; filename="' . $fichier . '"');
header('Content-Type: application/force-download');
header('Content-Transfer-Encoding: binary');
header('Content-Length: '. filesize($chemin));
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
readfile($chemin);
$file = 'file.csv';
 */

header('Content-disposition: attachment; filename="' . $fichier . '"');
header('Content-type: application/octetstream');

readfile($fichier);
}
if($_REQUEST['extraire']=='Telecharger Fasta'){
/* code pour concatener deux fichier
 $fichier1 = 'fichier_1.txt';
 $fichier2 = 'fichier_2.txt';

 $data = file_get_contents($fichier2);
 file_put_contents($fichier1, $data, FILE_APPEND);*/
}
?>
