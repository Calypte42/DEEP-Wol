<?php

require_once '../BDD/bdd.php';
$bdd = connexionbd();

// Web Service pour verification de l'authentification

session_start(); // demarrage d'une session

$login = $_GET['login'];
$mdp = $_GET['mdp'];

$requete = "SELECT mdp,role from compte WHERE pseudo='$login'";  // On prepare une requete permettant de recupere l'ensemble des valeurs qui nous interessent
$value = requete($bdd,$requete); // value recupere la reponse de la requete

// Récuperation du mot de passe si utilisateur existant
if ($value) {
    $mdpUtilisateur = $value[0]['mdp'];
    $roleAdmin=$value[0]['role'];
} else {
    $mdpUtilisateur = null;
}

// Les deux opérations suivantes servent à fermer la connexion à la requête et
// à la base de données
$value = null;
$bdd = null;

if ($mdp == $mdpUtilisateur) {

    $_SESSION['identifie'] = 1; // 1 pour connecté, 0 pour déconnecté
        if($roleAdmin=="admin"){
            $_SESSION['admin'] = 1;
          }
          else {
            $_SESSION['admin']=0;
          }

    header('Refresh: 0; URL=..');
    echo "Authentification réussie ! Redirection dans 3 secondes...";
    /*
	http_response_code(200); // succès de la requête
    */
} else {
    header('Refresh: 3; URL=../connexion.php');
    echo "Echec de l'authentification ! Redirection dans 3 secondes...";
    /*
	http_response_code(401); // utilisateur non authentifié
    */
}

?>
