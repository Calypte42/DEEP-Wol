<?php
include "BDD/bdd.php";
$bdd=connexionbd();
//include "html/entete.html";
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Authentification</title>
		<link rel = 'stylesheet' href = 'css/style.css' type='text/css' />
	</head>
	
	<body>
		<h1> Nom du site </h1> <!-- Titre de la page d'authentification : à définir -->

		<p>En collaboration avec l'Université de Montpellier, le Muséum d’Histoire Naturelle de Paris et l’association OSEA</p>

		</br>
		
		<p>Veuillez vous authentifier pour accéder au site</p>
		
		<div id="authentification" style="width:280px; height:200px; border:2px solid;">
			
			<!-- formulaire d'accès au site -->
			</br>
			<form method= "GET" action="authentification.php"> <!-- renvoie au .php qui vérifie l'authentification de l'utilisateur-->
				&nbsp;&nbsp;<label>Nom d'utilisateur</label>
				</br> 
				&nbsp;&nbsp;<input required type="text" id ="login" name="login" size="15"/> * </br></br>
	
				&nbsp;&nbsp;<label>Mot de passe</label>
				</br>
				&nbsp;&nbsp;<input required type="password" id ="mdp" name="mdp" size="15"/> * </br></br>
	
				&nbsp;&nbsp;<label>Se souvenir de moi</label>
				<input type="checkbox" name="seSouvenir"/>
				
				&nbsp;&nbsp;<input type="submit" name="submit" value="login"/>
				</br>
			</form>
		</div>
	</body>
</html>
