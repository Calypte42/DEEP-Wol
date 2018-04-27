document.addEventListener('DOMContentLoaded', function() {


// Affiche la liste des tuples de la bdd
    function liste() {

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
                    new_html += '<td>' + ret.resultat[i].nomCavite + '</td>';
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

    var formRecherche=document.getElementById("formRecherche");
    formRecherche.addEventListener("submit",function(event){
      event.preventDefault();
      liste();
    })





})
