<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
include 'consultationModification.php';
?>

	<div class="container" style="margin-top:-400px; margin-right:80px;">
    <?php echo "Liste des sites de la grottes : ".$_REQUEST['grotte']; ?>
		<table class="table table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th>Numéro Site</th>
					<th>Profondeur</th>
					<th>Temperature</th>
					<th>Type de sol</th>
					<th>Distance a l entree</th>
					<th>Presence d'eau</th>
					<th>Code equipe speleo</th>
					<th>Modifier</th>
				</tr>
			<thead>
			<tbody>

			<?php


$requete='SELECT id,numSite,profondeur,temperature,typeSol,distanceEntree,presenceEau,codeEquipeSpeleo from Site where idGrotte=\''.$_REQUEST["idGrotte"].'\'';  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
	foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
      if($cle=='id'){
        $id=$resultat;
      }else{
      if($cle=='numsite'){
			 echo "<td><a href='tableauPiege.php?idSite=$id&site=$resultat'>$resultat</a></td> ";
     }else {
       if(empty($resultat)){
         echo "<td>Non renseigné</td>";
         }else{
       echo "<td>$resultat</td> ";
     }}

   }}
   echo ('<td><a href="">'."Modifier".'</a></td></tr>');
}
echo "</table>";
?>
			</tbody>
		</table>

	</div>

	<form style="float:right" name="versAjoutSite" method="POST" action="ajoutSite.php">
		<input type="submit" value="Ajouter un site" />
	</form>

<?php
include 'HTML/pied.html';
?>
