document.addEventListener('DOMContentLoaded', function() {


// Affiche la liste des tuples de la bdd
    function listeGrotte() {

        var request = new XMLHttpRequest(); // on prepare AJAX

        request.addEventListener('load', function(data) { // Quand la requete sera envoye on affichera
            var ret = JSON.parse(data.target.responseText); // le resultat de la requete sous forme de tableau
            var new_html = '';
            console.log(ret);
            if (ret.resultat.length == 0) {
                new_html += '<br/>Aucune données ne correspond a votre recherche';
                document.querySelector('#listing').innerHTML = new_html; //reference la div dont id=listing sur recherche.php
            } else {
                new_html += '<div><br/>';
                new_html += '<table>';
                new_html += '<tr>';
                new_html += '<th> Nom Cavite </th>';
                new_html += '<th>Type Cavite </th>';
                new_html += '<th> Latitude </th>';
                new_html += '<th> Longitude </th>';
                new_html += '<th> Type Acces </th>';
                new_html += '<th> Acces Public</th>';
                new_html += '<th> Nom Systeme Hydrographique </th>';
                new_html += '</tr>';
                for (var i = 0; i < ret.resultat.length; i++) {
                    new_html += '<tr>';
                    new_html += '<td><a href=\'tableauSite.php?idGrotte='+ ret.resultat[i].id+'&grotte='+ret.resultat[i].nomCavite+'\'>' +  ret.resultat[i].nomCavite + '</a></td>';
                    new_html += '<td>' + ret.resultat[i].typeCavite + '</td>';
                    new_html += '<td>' + ret.resultat[i].latitude + '</td>';
                    new_html += '<td>' + ret.resultat[i].longitude + '</td>';
                    new_html += '<td>' + ret.resultat[i].typeAcces + '</td>';
                    new_html += '<td>' + ret.resultat[i].accesPublic + '</td>';
                    new_html += '<td>' + ret.resultat[i].nom + '</td>';
                    new_html += '</tr>';
                }
                new_html += '</table></div><br/>';
                document.querySelector('#listing').innerHTML = new_html;

            }


        });
        request.open("POST", "WebService/rechercheWS.php"); // on envoie la requete
        request.send(new FormData(formRecherche));
    }

    // Affiche la liste des tuples de la bdd
        function listeSite() {

            var request = new XMLHttpRequest(); // on prepare AJAX

            request.addEventListener('load', function(data) { // Quand la requete sera envoye on affichera
                var ret = JSON.parse(data.target.responseText); // le resultat de la requete sous forme de tableau
                var new_html = '';
                console.log(ret);
                if (ret.resultat.length == 0) {
                    new_html += '<br/>Aucune données ne correspond a votre recherche';
                    document.querySelector('#listing').innerHTML = new_html; //reference la div dont id=listing sur recherche.php
                } else {
                    new_html += '<div><br/>';
                    new_html += '<table>';
                    new_html += '<tr>';
                    new_html += '<th> Numero Site </th>';
                    new_html += '<th>Profondeur </th>';
                    new_html += '<th> Type de sol </th>';
                    new_html += '<th> Distance a l\'entree </th>';
                    new_html += '<th> Presence d\'eau </th>';
                    new_html += '<th> Code Equipe Speleo</th>';
                    new_html += '<th> Nom Grotte </th>';
                    new_html += '</tr>';
                    for (var i = 0; i < ret.resultat.length; i++) {
                        new_html += '<tr>';
                        new_html += '<td><a href=\'tableauPiege.php?idSite='+ret.resultat[i].id+'&site='+ret.resultat[i].numSite+'&idGrotte='+ret.resultat[i].idGrotte+'&nomGrotte='+ret.resultat[i].nomCavite+'\'>' + ret.resultat[i].numSite + '</a></td>';
                        new_html += '<td>' + ret.resultat[i].profondeur + '</td>';
                        new_html += '<td>' + ret.resultat[i].typeSol + '</td>';
                        new_html += '<td>' + ret.resultat[i].distanceEntree + '</td>';
                        new_html += '<td>' + ret.resultat[i].presenceEau + '</td>';
                        new_html += '<td>' + ret.resultat[i].codeEquipeSpeleo + '</td>';
                        new_html += '<td>' + ret.resultat[i].nomCavite + '</td>';
                        new_html += '</tr>';
                    }
                    new_html += '</table></div><br/>';
                    document.querySelector('#listing').innerHTML = new_html;

                }


            });
            request.open("POST", "WebService/rechercheWS.php"); // on envoie la requete
            request.send(new FormData(formRecherche));


        }


        // Affiche la liste des tuples de la bdd
            function listePiege() {

                var request = new XMLHttpRequest(); // on prepare AJAX

                request.addEventListener('load', function(data) { // Quand la requete sera envoye on affichera
                    var ret = JSON.parse(data.target.responseText); // le resultat de la requete sous forme de tableau
                    var new_html = '';
                    console.log(ret);
                    if (ret.resultat.length == 0) {
                        new_html += '<br/>Aucune données ne correspond a votre recherche';
                        document.querySelector('#listing').innerHTML = new_html; //reference la div dont id=listing sur recherche.php
                    } else {
                        new_html += '<div><br/>';
                        new_html += '<table>';
                        new_html += '<tr>';
                        new_html += '<th>Code du Piege </th>';
                        new_html += '<th>Date de pose</th>';
                        new_html += '<th>Date de recuperation</th>';
                        new_html += '<th>Heure de recuperation</th>';
                        new_html += '<th>Probleme</th>';
                        new_html += '<th>Date de tri</th>';
                        new_html += '<th>Temperature</th>';
                        new_html += '<th>Code Equipe Speleo</th>';
                        new_html += '<th>Site</th>';
                        new_html += '<th>Grotte</th>';
                        new_html += '</tr>';
                        for (var i = 0; i < ret.resultat.length; i++) {
                            new_html += '<tr>';
                            new_html += '<td><a href=\'tableauEchantillon.php?piege='+ ret.resultat[i].codePiege +'&nomGrotte='+ ret.resultat[i].nomCavite +'&idGrotte='+ ret.resultat[i].idGrotte +'&site='+ ret.resultat[i].numSite +'&idSite='+ ret.resultat[i].idSite +'\'>' + ret.resultat[i].codePiege + '</a></td>';
                            new_html += '<td>' + ret.resultat[i].datePose + '</td>';
                            new_html += '<td>' + ret.resultat[i].heurePose + '</td>';
                            new_html += '<td>' + ret.resultat[i].dateRecup + '</td>';
                            new_html += '<td>' + ret.resultat[i].heureRecup + '</td>';
                            new_html += '<td>' + ret.resultat[i].probleme + '</td>';
                            new_html += '<td>' + ret.resultat[i].dateTri + '</td>';
                            new_html += '<td>' + ret.resultat[i].temperature + '</td>';
                            new_html += '<td>' + ret.resultat[i].codeEquipeSpeleo + '</td>';
                            new_html += '<td>' + ret.resultat[i].numSite + '</td>';
                            new_html += '<td>' + ret.resultat[i].nomCavite + '</td>';
                            new_html += '</tr>';
                        }
                        new_html += '</table></div><br/>';
                        document.querySelector('#listing').innerHTML = new_html;

                    }


                });
                request.open("POST", "WebService/rechercheWS.php"); // on envoie la requete
                request.send(new FormData(formRecherche));


            }

            // Affiche la liste des tuples de la bdd
                function listeEchantillon() {

                    var request = new XMLHttpRequest(); // on prepare AJAX

                    request.addEventListener('load', function(data) { // Quand la requete sera envoye on affichera
                        var ret = JSON.parse(data.target.responseText); // le resultat de la requete sous forme de tableau
                        var new_html = '';
                        console.log(ret);
                        if (ret.resultat.length == 0) {
                            new_html += '<br/>Aucune données ne correspond a votre recherche';
                            document.querySelector('#listing').innerHTML = new_html; //reference la div dont id=listing sur recherche.php
                        } else {
                            new_html += '<div><br/>';
                            new_html += '<table>';
                            new_html += '<tr>';
                            new_html += '<th>Numero echantillon</th>';
                            new_html += '<th>Forme de stockage</th>';
                            new_html += '<th>Lieu de stockage</th>';
                            new_html += '<th>Niveau Identification</th>';
                            new_html += '<th>Auteur identification</th>';
                            new_html += '<th>Infecte Bacterie</th>';
                            new_html += '<th>Code Piege</th>';
                            new_html += '<th>Site</th>';
                            new_html += '<th>Grotte</th>';
                            new_html += '</tr>';
                            for (var i = 0; i < ret.resultat.length; i++) {
                                new_html += '<tr>';
                                new_html += '<td><a href=\'tableauAnalyse.php?idEchantillon=' + ret.resultat[i].id + '&numEchantillon=' + ret.resultat[i].numEchantillon + '&piege=' + ret.resultat[i].codePiege + '&nomGrotte=' + ret.resultat[i].nomCavite + '&idGrotte=' + ret.resultat[i].idGrotte + '&site=' + ret.resultat[i].numSite + '&idSite=' + ret.resultat[i].idSite + '\'>' + ret.resultat[i].numEchantillon + '</a></td>';
                                new_html += '<td>' + ret.resultat[i].formeStockage + '</td>';
                                new_html += '<td>' + ret.resultat[i].lieuStockage + '</td>';
                                new_html += '<td>' + ret.resultat[i].niveauIdentification + '</td>';
                                new_html += '<td>' + ret.resultat[i].initiale + '</td>';
                                new_html += '<td>' + ret.resultat[i].infecteBacterie + '</td>';
                                new_html += '<td>' + ret.resultat[i].codePiege + '</td>';
                                new_html += '<td>' + ret.resultat[i].numSite + '</td>';
                                new_html += '<td>' + ret.resultat[i].nomCavite + '</td>';
                                new_html += '</tr>';
                            }
                            new_html += '</table></div><br/>';
                            document.querySelector('#listing').innerHTML = new_html;

                        }


                    });
                    request.open("POST", "WebService/rechercheWS.php"); // on envoie la requete
                    request.send(new FormData(formRecherche));


                }

    var formRecherche=document.getElementById("formRecherche");
    var select = document.getElementById("choixRecherche");

    formRecherche.addEventListener("submit",function(event){
      event.preventDefault();
      if(select.value=="Grotte"){
      listeGrotte();
    }
    if(select.value=="Site"){
    listeSite();
    }
    if(select.value=="Piege"){
    listePiege();
    }
    if(select.value=="Echantillon"){
    listeEchantillon();
    }

    })





})
