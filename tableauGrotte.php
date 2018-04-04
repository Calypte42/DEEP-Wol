<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

	<div class="container" style="margin-top:-400px; margin-right:80px;">
		Liste des grottes de la base de donnée : </br>
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
					<th>Supprimer</th>
				</tr>
			<thead>
			<tbody>

<?php

$requete='SELECT g.id,nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic,h.nom from Grotte g, SystemeHydrographique h WHERE idSystemeHydrographique=h.id';  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/
$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
	foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
		if($cle=='id'){
		 $id=$resultat;
	 }else{
			if($cle=='nomcavite'){
			 echo "<td><a href='tableauSite.php?idGrotte=$id&grotte=$resultat'>$resultat</a></td> ";
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
				echo "<td>Non renseigné</td>";
			}}

		}}
		echo ('<td><a href="">'."Modifier".'</a></td></tr>');
}
echo "</table>";
?>
			</tbody>
		</table>

	</div>

	<form style="float:right" name="versAjoutGrotte" method="POST" action="ajoutGrotte.php">
		<input type="submit" value="Ajouter une Grotte" />
	</form>

<?php
include 'HTML/pied.html';
?>
