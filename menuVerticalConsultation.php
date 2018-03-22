<!Doctype html>

<html>
	<head>
		<meta charset='utf-8'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!-- style Bootstrap v3.3.7 -->
 		<link rel="stylesheet" href="CSS/entete.css">
		<link rel="stylesheet" href="CSS/menuVertical.css" type="text/css">

	</head>

	<body>	
<?php
include'HTML/entete.html';
?>

	</br>
	</br>
	</br>
	</br>
		<!-- ONGLETS NAVIGATION VERTICALE GAUCHE -->
		
		<div id='menuVertical'>
			<ul>
			   <li><a href='#'><span>Grotte</span></a></li>
			   </br>
			   <li><a href='#'><span>Site</span></a></li>
			   </br>
			   <li><a href='#'><span>Piège</span></a></li>
			   </br>
			   <li class='active has-sub'><a href=''><span>Individu</span></a>
			      <ul>
				 <li class='sousMenu'><a href=''><span>Gène</span></a></li>
				 <li class='sousMenu1'><a href=''><span>Taxonomie</span></a></li>
			      </ul>
			   </li>
			</ul>
		</div>


		<!-- BARRE RECHERCHE -->
		
		<form class="navbar-form" role="search">
			<div class="input-group">
				<input class="form-control" type="text" placeholder="Rechercher..." size="30">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit">
					<i class="glyphicon glyphicon-search"></i>
					</button>
				</div>
			</div>
		</form>
	</body>
</html>
