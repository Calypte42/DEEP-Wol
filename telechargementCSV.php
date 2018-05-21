<?php
// ce fichier gère le téléchargement des fichiers fasta et csv
include 'BDD/bdd.php';
$bdd=connexionbd();


//-------------------------------- Preparation de la clause WHERE :

$listeWhere=" WHERE 1=1 AND ";

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

if($_REQUEST['extraire']=='Telecharger Fasta'){
if(!empty($_REQUEST['selectChoixGene'])){
    $listeWhere=$listeWhere.'nomGene=\''.$_REQUEST['selectChoixGene'].'\'';
  }
  $listeWhere=$listeWhere.' AND ';
}
$listeWhere=rtrim($listeWhere,' AND ');
//--------------------------------FIN  Preparation de la clause WHERE ----------------

// parametrage du nom du fichier en sorti avec nom par defaut
if(!empty($_REQUEST['nomFichier'])){
  $nomFichierSorti=$_REQUEST['nomFichier'];
}else{
  if($_REQUEST['extraire']=='Telecharger CSV'){
    $nomFichierSorti="DEEP-CSV.csv";
  }
  if($_REQUEST['extraire']=='Telecharger Fasta'){
    $nomFichierSorti="DEEP-Fasta.fasta";
  }
}

// ------------------------------ Gestion de l'extraction des fasta -------------------
// Extraction mise au point grace au code trouvé ici ;
// https://jeanbaptistemarie.com/notes/code/php/creer-un-fichier-csv-avec-php.html en Avril 2018

if($_REQUEST['extraire']=='Telecharger CSV'){
// Paramétrage de l'écriture du futur fichier CSV
$chemin = './fichierTest.csv';
$fichier = 'fichierTest.csv';
$delimiteur = "\t"; // Pour une tabulation, utiliser $delimiteur = "\t";

$enTete[]=array();
$listeSelect="";


// On prepare la commande select avec les valeurs recuperer par les checkbox

foreach ($_REQUEST['listeItem'] as $key) {
  $listeSelect=$listeSelect.$key.',';
  $enTete[0][]=$key; // On insere le nom de la table dans le tableau permettant d afficher le nom des colonnes dans le csv.
}
$listeSelect=rtrim($listeSelect,',');


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

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */


foreach ($value as $ligne) { /* On parcourt le tableau de tableau */
    // chaque ligne en cours de lecture est insérée dans le fichier
  	// les valeurs présentes dans chaque ligne seront séparées par $delimiteur
  	fputcsv($fichier_csv, $ligne, $delimiteur);
}

// fermeture du fichier csv
fclose($fichier_csv);


header('Content-disposition: attachment; filename="'.$nomFichierSorti.'"');
header('Content-type: application/octetstream');

readfile($fichier);
}


if($_REQUEST['extraire']=='Telecharger Fasta'){

  // fichier de base creer sur le serveur avant exportation
  $fichier = 'fichierTest.fasta';

  // on remet ce fichier vide pour pouvoir ecrire le contenu
  fclose(fopen($fichier,"w"));
  // on recupere les chemins des differents fichier fasta
  $requete='SELECT fasta from V_Analyse '.$listeWhere;
  $value=requete($bdd,$requete); /* value recupere la reponse de la requete */


  foreach ($value as $valeur) {
    foreach ($valeur as $lien) {
    $data = file_get_contents($lien);
    file_put_contents($fichier, $data, FILE_APPEND);
  }
}


  header('Content-disposition: attachment; filename="'.$nomFichierSorti.'"');
  header('Content-type: application/octetstream');

  readfile($fichier);
}
?>
