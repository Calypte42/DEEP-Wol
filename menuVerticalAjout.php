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
			   <li><a href='ajoutGrotte.php'><span>Grotte</span></a></li>
			   </br>
			   <li><a href='ajoutSite.php'><span>Site</span></a></li>
			   </br>
			   <li><a href='ajoutPiege.php'><span>Piège</span></a></li>
			   </br>
			   <li class='active has-sub'><a href='ajoutIndividu.php'><span>Individu</span></a>
			      <ul>
				 <li class='sousMenu'><a href='ajoutGene.php'><span>Gène</span></a></li>
				 <li class='sousMenu1'><a href='ajoutTaxonomie.php'><span>Taxonomie</span></a></li>
			      </ul>
			   </li>
			</ul>
		</div>

	</body>
</html>
