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

$requete='SELECT nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic,h.nom from Grotte, SystemeHydrographique h WHERE idSystemeHydrographique=h.id';  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/
$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
	foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
			echo "$cle";
			if($cle=='nomcavite'){
			 echo "<td><a href='ajoutPiege.php?grotte=$resultat'>$resultat</a></td> ";
			}else {
				if(!empty($resultat)){
					if($cle=='accespublic'){

						if($resultat==0){
							echo "<td>Non</td> ";
						}
						if($resultat==1){
							echo "<td>Oui</td> ";
						}
					}else{
				echo "<td>$resultat</td> ";
			}}else{
				echo "<td>non renseigné</td>";
			}}

		}
		echo ('<td><a href="">'."Modifier".'</a></td></tr>');
}
echo "</table>";
?>
			</tbody>
		</table>

	</div>

<?php
include 'HTML/pied.html';
?>
