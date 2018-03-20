<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php

// Web Service pour verification de l'authentification

session_start(); // demarrage d'une session
	
$login=$_GET['login'];
$mdp=$_GET['mot_de_passe'];
$reponse=false;
$donneesJson = file_get_contents('authentificatio.json'); // Récupère le contenu du fichier .json sous forme d'une chaine de caractères
$array = json_decode($donneesJson, true); // Transforme en tableau

foreach($array as $log=>$tab){
	if ($log == $login){
		if($tab['mot_de_passe'] == $mdp){
			$reponse=true;
		}
	}
}	

if ($reponse == true){
	$_SESSION[$login] = 1; // 1 pour connecté, 0 pour déconnecté
	http_response_code(200); // succès de la requête
}else{
	http_response_code(401); // utilisateur non authentifié
}

?>
