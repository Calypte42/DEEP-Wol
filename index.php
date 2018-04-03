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

  		<link rel="stylesheet" href="Bootstrap/bootstrap.css">
  		<link rel = 'stylesheet' href = 'CSS/style.css' type='text/css' />
  		
  		<script src="Bootstrap/jquery.js"></script>
  		<script src="Bootstrap/bootstrap.js"></script>

	</head>
	
	<body class = "bg-warning" style="background:#ffffcc;">
	
		<div class="text-center">
			<h1> BD DEEP-Wol </h1>
			</br>
            		<h4>En collaboration avec l'Université de Montpellier, le Muséum d’Histoire Naturelle de Paris et l’association OSEA</h4>
           	</div>
          		
		</br>
				
		<div class="container" id="authentification">
		    <div class="row">
			<div class="col-md-offset-4 col-md-4" >
			    	<form method= "GET" action="authentification.php" class="form-login" style="background:#6e523f;">
			    	<h4 style="color:white;">Authentification</h4>
			    	 <div class="input-group">
			    	    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					    <input type="text" id="login" class="form-control input-sm chat-input" name="login" placeholder="Nom d'utilisateur" />
				</div>
				
				</br>
				
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input type="password" id="mdp" name="mdp" class="form-control input-sm chat-input" placeholder="Mot de passe" />
				</div>

				</br>

				<div class="wrapper" >
					<input type="submit" name="submit" value="login"/>
				</div>

				</form>
			</div>
		    </div>
		</div>
	
	</body>
</html>
