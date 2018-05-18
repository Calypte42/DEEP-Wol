<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';
?>

	<div class= "col-sm-10">
				Liste des grottes
				<table class="table table-bordered table-condensed" style="margin-top: 10px;">
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

					$requete='SELECT g.id,nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic from Grotte g, SystemeHydrographique h WHERE idSystemeHydrographique=h.id ORDER BY nomCavite';  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/
					$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
					foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
						foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
							if($cle=='id'){
							 $id=$resultat;
						 	}else{
								if($cle=='nomcavite'){
                                 $nomCavite = $resultat;
								 echo "<td><a href='tableauSite.php?idGrotte=$id&grotte=$resultat'>$resultat</a></td> ";
								}else{
									if(isset($resultat)){
										if($cle=='accespublic'){

											if($resultat==0){
												echo "<td>Non</td> ";
											}
											if($resultat==1){
												echo "<td>Oui</td> ";
											}
										}else{
												echo "<td>$resultat</td> ";
					            }
									}else{
												echo "<td>Non renseigné</td>";
									}
								}
							}
						}
                        $requete="SELECT nom, departement, pays from SystemeHydrographique
                                    WHERE id=(SELECT idSystemeHydrographique FROM Grotte WHERE id=$id)";
    					$value=requete($bdd,$requete); /* value recupere la reponse de la requete */

                        $nomSystemeHydro = $value[0]['nom'];
                        $departementSystemeHydro = $value[0]['departement'];
                        $paysSystemeHydro = $value[0]['pays'];
                        echo "<td>$nomSystemeHydro - $departementSystemeHydro - $paysSystemeHydro</td>";


			        echo "<td><form method='GET' action='modifGrotte.php'>";
			        echo "<input type='hidden' name='id' value='$id' />";
			        echo "<input type='submit' value='Modifier' />";
			        echo "</form></td>";
					//echo ('<td><a href="">'."Modifier".'</a></td>');
                    echo "<td><form method='GET' onsubmit='return suppression(this)'>";
                    echo "<input type='hidden' name='nom' value='$nomCavite' />";
                    echo "<input type='hidden' name='table' value='grotte' />";
                    echo "<input type='hidden' name='colonne' value='id' />";
			        echo "<input type='hidden' name='id' value='$id' />";
			        echo "<input type='submit' value='Supprimer' />";
			        echo "</form></td></tr>";
					//echo('<td><a href="">'."Supprimer".'</a></td></tr>');
					}
					echo "</table>";
					?>
				</tbody>
			</table>

			<form style="float:right" action="ajoutGrotte.php">
				<input type="submit" value="Ajouter une grotte" />
			</form>
		</div>
	</div> <!-- ferme le row de consultationModification -->
</div> <!-- ferme le container-fluid de consultationModification -->


<?php
include 'HTML/pied.html';
?>
