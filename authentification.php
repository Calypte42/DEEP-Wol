<?php

require_once 'BDD/bdd.php';
$bdd = connexionbd();

// Web Service pour verification de l'authentification

session_start(); // demarrage d'une session

$login = $_GET['login'];
$mdp = $_GET['mdp'];

$requete = "SELECT mdp from compte WHERE pseudo='$login'";  // On prepare une requete permettant de recupere l'ensemble des valeurs qui nous interessent
$value = requete($bdd,$requete); // value recupere la reponse de la requete

// Récuperation du mot de passe si utilisateur existant
if ($value) {
    $mdpUtilisateur = $value[0]['mdp'];
} else {
    $mdpUtilisateur = null;
}

// Les deux opérations suivantes servent à fermer la connexion à la requête et
// à la base de données
$value = null;
$bdd = null;

if ($mdp == $mdpUtilisateur) {
    $_SESSION[$login] = 1; // 1 pour connecté, 0 pour déconnecté
    header('Refresh: 3; URL=accueil.php');
    echo "Authentification réussie ! Redirection dans 3 secondes...";
    /*
	http_response_code(200); // succès de la requête
    */
} else {
    header('Refresh: 5; URL=index.php');
    echo "Echec de l'authentification ! Redirection dans 5 secondes...";
    /*
	http_response_code(401); // utilisateur non authentifié
    */
}

?>
