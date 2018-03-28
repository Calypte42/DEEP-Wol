<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
include 'consultationModification.php';
?>

	<div class="container" style="margin-top:-400px; margin-right:80px;">
		<table class="table table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Type de cavité</th>
					<th>Latitude</th>
					<th>Longitude</th>
					<th>Type d'accès</th>
					<th>Accès au public</th>
					<th>Système hydrographique</th>
					<th>Modifier</th>
				</tr>
			<thead>
			<tbody>
			
			<?php
			$requete='SELECT nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic,h.nom from Grotte, SystemeHydrographique h WHERE idSystemeHydrographique=h.id';  
			$value=requete($bdd,$requete);

			foreach ($value as $ligne) { 
				  	echo '<tr>';
				
				  	if ($ligne['nomcavite']){
				  		echo ('<td>'.$ligne['nomcavite']. '</td>');
		      			
		      			}else{
						echo ('<td>'."non renseigné".'</td>');
					}
					if ($ligne['typecavite']){
		      				echo ('<td>'.$ligne['typecavite']. '</td>');
			      		}else{	
			      			echo ('<td>'."non renseigné".'</td>');
			      		}
			      		if ($ligne['latitude']){
		      				echo ('<td>'.$ligne['latitude']. '</td>');
			      		}else{	
			      			echo ('<td>'."non renseigné".'</td>');
			      		}
			      		if ($ligne['longitude']){
		      				echo ('<td>'.$ligne['longitude']. '</td>');
			      		}else{	
			      			echo ('<td>'."non renseigné".'</td>');
			      		}
			      		if ($ligne['typeacces']){
		      				echo ('<td>'.$ligne['typeacces']. '</td>');
			      		}else{	
			      			echo ('<td>'."non renseigné".'</td>');
			      		}
			      		if ($ligne['accespublic'] && $ligne['accespublic']=="TRUE"){
		      				echo ('<td>'."oui". '</td>');
			      		}else{	
			      			echo ('<td>'."non".'</td>');
			      		}
			      		if ($ligne['nom']){
		      				echo ('<td>'.$ligne['nom']. '</td>');
			      		}else{	
			      			echo ('<td>'."non renseigné".'</td>');
			      		}
			      		echo ('<td><a href="">'."Modifier".'</a></td>');
			       	}
			  	echo ('</table>');
			  	?>
				<input type = "button" id="affichageGrotte" value = "ajouter une grotte" style="float:right;">

			</tbody>
		</table>
	
	</div>



<?php
include 'HTML/pied.html';
?>

