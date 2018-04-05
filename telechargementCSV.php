<?php
include 'BDD/bdd.php';
$bdd=connexionbd();


// Paramétrage de l'écriture du futur fichier CSV
$chemin = './fichierTest.csv';
$fichier = 'fichierTest.csv';
$delimiteur = ','; // Pour une tabulation, utiliser $delimiteur = "t";
$enTete[] = array('numEchantillon','formeStockage','lieuStockage','niveauIdentification','infecteBacterie','nombreindividu','codepiege','datepose','heurepose','daterecup','heurerecup','probleme','datetri','profondeur','temperature','typesol','numsite','distanceentree','presenceeau','nomcavite','typecavite','latitude','longitude','typeacces','accespublic','sys.nom','departement','classe','ordre','famille','sousfamille','genre','espece','photo','nomAuteur','prenomAuteur');

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

$requete='SELECT * from V_Echantillon_AvecTaxo';
$value=requete($bdd,$requete); /* value recupere la reponse de la requete */


foreach ($value as $ligne) { /* On parcourt le tableau de tableau */
    // chaque ligne en cours de lecture est insérée dans le fichier
  	// les valeurs présentes dans chaque ligne seront séparées par $delimiteur
  	fputcsv($fichier_csv, $ligne, $delimiteur);
}

$requete='SELECT * from V_Echantillon_SansTaxo';
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
