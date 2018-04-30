document.addEventListener('DOMContentLoaded', function() {


// Affiche la liste des tuples de la bdd
    function listeGrotte() {

        var request = new XMLHttpRequest(); // on prepare AJAX

        request.addEventListener('load', function(data) { // Quand la requete sera envoye on affichera
            var ret = JSON.parse(data.target.responseText); // le resultat de la requete sous forme de tableau
            var new_html = '';
            console.log(ret);
            if (ret.resultat.length == 0) {
                new_html += '<div style ="margin-top:50px; text-align:center;"><br/>Aucune donnée ne correspond à votre recherche</div>';
                document.querySelector('#listing').innerHTML = new_html; //reference la div dont id=listing sur recherche.php
            } else {
                new_html += '<div class = "col-sm-10">';
                new_html += '<div><br/>';
                new_html += '<table class="table table-bordered table-condensed" style="margin-top: 50px; text-align:center;">';
                new_html += '<tr>';
                new_html += '<th style="text-align:center;"> Nom Cavite </th>';
                new_html += '<th style="text-align:center;">Type Cavite </th>';
                new_html += '<th style="text-align:center;"> Latitude </th>';
                new_html += '<th style="text-align:center;"> Longitude </th>';
                new_html += '<th style="text-align:center;"> Type Acces </th>';
                new_html += '<th style="text-align:center;"> Acces Public</th>';
                new_html += '<th style="text-align:center;"> Nom Systeme Hydrographique </th>';
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
                new_html += '</div>';
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
                    new_html += '<div style ="margin-top:50px; text-align:center;"><br/>Aucune donnée ne correspond à votre recherche</div>';
                    document.querySelector('#listing').innerHTML = new_html; //reference la div dont id=listing sur recherche.php
                } else {
                    new_html += '<div class = "col-sm-10">';
                    new_html += '<div><br/>';
                    new_html += '<table class="table table-bordered table-condensed" style="margin-top: 50px; text-align:center;">';
                    new_html += '<tr>';
                    new_html += '<th style="text-align:center;"> Numero Site </th>';
                    new_html += '<th style="text-align:center;">Profondeur </th>';
                    new_html += '<th style="text-align:center;"> Type de sol </th>';
                    new_html += '<th style="text-align:center;"> Distance a l\'entree </th>';
                    new_html += '<th style="text-align:center;"> Presence d\'eau </th>';
                    new_html += '<th style="text-align:center;"> Code Equipe Speleo</th>';
                    new_html += '<th style="text-align:center;"> Nom Grotte </th>';
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
                    new_html += '</div>';
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
                        new_html += '<div style ="margin-top:50px; text-align:center;"><br/>Aucune donnée ne correspond à votre recherche</div>';
                        document.querySelector('#listing').innerHTML = new_html; //reference la div dont id=listing sur recherche.php
                    } else {
                        new_html += '<div class = "col-sm-10">';
                        new_html += '<div><br/>';
                        new_html += '<table class="table table-bordered table-condensed" style="margin-top: 50px; text-align:center;">';
                        new_html += '<tr>';
                        new_html += '<th style="text-align:center;">Code du Piege </th>';
                        new_html += '<th style="text-align:center;">Date de pose</th>';
                        new_html += '<th style="text-align:center;">Heure de pose</th>';
                        new_html += '<th style="text-align:center;">Date de recuperation</th>';
                        new_html += '<th style="text-align:center;">Heure de recuperation</th>';
                        new_html += '<th style="text-align:center;">Probleme</th>';
                        new_html += '<th style="text-align:center;">Date de tri</th>';
                        new_html += '<th style="text-align:center;">Temperature</th>';
                        new_html += '<th style="text-align:center;">Code Equipe Speleo</th>';
                        new_html += '<th style="text-align:center;">Site</th>';
                        new_html += '<th style="text-align:center;">Grotte</th>';
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
                        new_html += '</div>';
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
                            new_html += '<div style ="margin-top:50px; text-align:center;"><br/>Aucune donnée ne correspond à votre recherche</div>';
                            document.querySelector('#listing').innerHTML = new_html; //reference la div dont id=listing sur recherche.php
                        } else {
                            new_html += '<div class = "col-sm-10">';
                            new_html += '<div><br/>';
                            new_html += '<table class="table table-bordered table-condensed" style="margin-top: 50px; text-align:center;">';
                            new_html += '<tr>';
                            new_html += '<th style="text-align:center;">Numero echantillon</th>';
                            new_html += '<th style="text-align:center;">Forme de stockage</th>';
                            new_html += '<th style="text-align:center;">Lieu de stockage</th>';
                            new_html += '<th style="text-align:center;">Niveau Identification</th>';
                            new_html += '<th style="text-align:center;">Auteur identification</th>';
                            new_html += '<th style="text-align:center;">Infecte Bacterie</th>';
                            new_html += '<th style="text-align:center;">Code Piege</th>';
                            new_html += '<th style="text-align:center;">Site</th>';
                            new_html += '<th style="text-align:center;">Grotte</th>';
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
                            new_html += '</div>';
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
