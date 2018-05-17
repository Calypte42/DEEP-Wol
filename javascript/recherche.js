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
        new_html += '<th style="text-align:center;"> Modifier </th>';
        new_html += '<th style="text-align:center;"> Supprimer </th>';
        new_html += '</tr>';
        for (var i = 0; i < ret.resultat.length; i++) {
          new_html += '<tr>';
          new_html += '<td><a href=\'tableauSite.php?idGrotte='+ ret.resultat[i].id+'&grotte='+ret.resultat[i].nomCavite+'\'>' +  ret.resultat[i].nomCavite + '</a></td>';
          new_html += '<td>' + ret.resultat[i].typeCavite + '</td>';

          if(ret.resultat[i].latitude==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].latitude + '</td>';
          }

          if(ret.resultat[i].longitude==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].longitude + '</td>';
          }

          new_html += '<td>' + ret.resultat[i].typeAcces + '</td>';
          if(ret.resultat[i].accesPublic==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            if(ret.resultat[i].accesPublic=true){
              new_html += '<td> Oui </td>';
            }
            else {
              new_html += '<td> Non </td>';
            }
          }
          new_html += '<td>' + ret.resultat[i].nom + '</td>';

          new_html += "<td><form method='GET' action='modifGrotte.php'>";
          new_html += "<input type='hidden' name='id' value='"+ ret.resultat[i].id +"'/>";
          new_html += "<input type='submit' value='Modifier' />";
          new_html += "</form></td>";
      //new_html += ('<td><a href="">'."Modifier".'</a></td>');
                new_html += "<td><form method='GET' onsubmit='return suppression(this)'>";
                new_html += "<input type='hidden' name='nom' value='"+ret.resultat[i].nomCavite+"'/>";
                new_html += "<input type='hidden' name='table' value='grotte' />";
                new_html += "<input type='hidden' name='colonne' value='id' />";
          new_html += "<input type='hidden' name='id' value='"+ ret.resultat[i].id +"'/>";
          new_html += "<input type='submit' value='Supprimer' />";
          new_html += "</form></td></tr>";

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
      console.log(data.target.responseText);
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
        new_html += '<th style="text-align:center;"> Modifier </th>';
        new_html += '<th style="text-align:center;"> Supprimer </th>';
        new_html += '</tr>';
        for (var i = 0; i < ret.resultat.length; i++) {
          new_html += '<tr>';
          new_html += '<td><a href=\'tableauPiege.php?idSite='+ret.resultat[i].id+'&site='+ret.resultat[i].numSite+'&idGrotte='+ret.resultat[i].idGrotte+'&nomGrotte='+ret.resultat[i].nomCavite+'\'>' + ret.resultat[i].numSite + '</a></td>';

          if(ret.resultat[i].profondeur==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].profondeur + '</td>';
          }


          if(ret.resultat[i].typeSol==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].typeSol + '</td>';
          }


          new_html += '<td>' + ret.resultat[i].distanceEntree + '</td>';
          if(ret.resultat[i].presenceEau==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            if(ret.resultat[i].presenceEau=true){
              new_html += '<td> Oui </td>';
            }
            else {
              new_html += '<td> Non </td>';
            }
          }
          new_html += '<td>' + ret.resultat[i].codeEquipeSpeleo + '</td>';
          new_html += '<td>' + ret.resultat[i].nomCavite + '</td>';

          new_html += "<td><form method='GET' action='modifSite.php'>";
          new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].id+"' />";
          new_html += "<input type='hidden' name='idGrotte' value='"+ret.resultat[i].idGrotte+"'/>";
          new_html += "<input type='hidden' name='grotte' value='"+ret.resultat[i].nomCavite+"'/>";
          new_html += "<input type='submit' value='Modifier' />";
          new_html += "</form></td>";

          new_html += "<td><form method='GET' onsubmit='return suppression(this)'>";
          new_html += "<input type='hidden' name='nom' value='"+ret.resultat[i].numSite+"'/>";
          new_html += "<input type='hidden' name='table' value='site' />";
          new_html += "<input type='hidden' name='colonne' value='id' />";
          new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].id+"' />";
          new_html += "<input type='submit' value='Supprimer' />";
          new_html += "</form></td></tr>";

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
        new_html += '<th style="text-align:center;">Modifier</th>';
        new_html += '<th style="text-align:center;">Supprimer</th>';
        new_html += '</tr>';
        for (var i = 0; i < ret.resultat.length; i++) {
          new_html += '<tr>';
          new_html += '<td><a href=\'tableauEchantillon.php?piege='+ ret.resultat[i].codePiege +'&nomGrotte='+ ret.resultat[i].nomCavite +'&idGrotte='+ ret.resultat[i].idGrotte +'&site='+ ret.resultat[i].numSite +'&idSite='+ ret.resultat[i].idSite +'\'>' + ret.resultat[i].codePiege + '</a></td>';

          if(ret.resultat[i].datePose==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].datePose + '</td>';
          }


          if(ret.resultat[i].heurePose==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].heurePose + '</td>';
          }



          if(ret.resultat[i].dateRecup==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].dateRecup + '</td>';
          }


          if(ret.resultat[i].heureRecup==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].heureRecup + '</td>';
          }


          if(ret.resultat[i].probleme==null){
            new_html += '<td>  </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].probleme + '</td>';
          }

          if(ret.resultat[i].dateTri==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].dateTri + '</td>';
          }


          if(ret.resultat[i].temperature==null){
            new_html += '<td> Non renseigné </td>';
          }
          else{
            new_html += '<td>' + ret.resultat[i].temperature + '</td>';
          }


          new_html += '<td>' + ret.resultat[i].codeEquipeSpeleo + '</td>';
          new_html += '<td>' + ret.resultat[i].numSite + '</td>';
          new_html += '<td>' + ret.resultat[i].nomCavite + '</td>';

          new_html += "<td><form method='GET' action='modifPiege.php'>";
          new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].codePiege+"' />";
          new_html += "<input type='hidden' name='nomGrotte' value='"+ret.resultat[i].nomCavite+"' />";
          new_html += "<input type='hidden' name='idGrotte' value='"+ret.resultat[i].idGrotte+"' />";
          new_html += "<input type='hidden' name='site' value='"+ret.resultat[i].numSite+"' />";
          new_html += "<input type='hidden' name='idSite' value='"+ret.resultat[i].idSite+"' />";
          new_html += "<input type='submit' value='Modifier' />";
          new_html += "</form></td>";
     	 //new_html += ('<td><a href="">'."Modifier".'</a></td>');
          new_html += "<td><form method='GET' onsubmit='return suppression(this)'>";
          new_html += "<input type='hidden' name='nom' value='"+ret.resultat[i].codePiege+"' />";
          new_html += "<input type='hidden' name='table' value='piege' />";
          new_html += "<input type='hidden' name='colonne' value='codePiege' />";
          new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].codePiege+"' />";
          new_html += "<input type='submit' value='Supprimer' />";
          new_html += "</form></td></tr>";
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
      console.log(data.target.responseText);
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
        new_html += '<th style="text-align:center;">Modifier</th>';
        new_html += '<th style="text-align:center;">Supprimer</th>';
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

          new_html += "<td><form method='GET' action='modifEchantillon.php'>";
          new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].id+"' />";
          new_html += "<input type='hidden' name='nomGrotte' value='"+ret.resultat[i].nomCavite+"' />";
          new_html += "<input type='hidden' name='idGrotte' value='"+ret.resultat[i].idGrotte+"' />";
          new_html += "<input type='hidden' name='site' value='"+ret.resultat[i].numSite+"' />";
          new_html += "<input type='hidden' name='idSite' value='"+ret.resultat[i].idSite+"' />";
          new_html += "<input type='hidden' name='piege' value='"+ret.resultat[i].codePiege+"' />";
          new_html += "<input type='submit' value='Modifier' />";
          new_html += "</form></td>";
      //new_html += ('<td><a href="">'."Modifier".'</a></td>');
          new_html += "<td><form method='GET' onsubmit='return suppression(this)'>";
          new_html += "<input type='hidden' name='nom' value='"+ret.resultat[i].numEchantillon+"' />";
          new_html += "<input type='hidden' name='table' value='echantillon' />";
          new_html += "<input type='hidden' name='colonne' value='id' />";
          new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].id+"' />";
          new_html += "<input type='submit' value='Supprimer' />";
          new_html += "</form></td></tr>";

        }
        new_html += '</table></div><br/>';
        new_html += '</div>';
        document.querySelector('#listing').innerHTML = new_html;

      }


    });
    request.open("POST", "WebService/rechercheWS.php"); // on envoie la requete
    request.send(new FormData(formRecherche));


  }

  function listeTaxonomie() {

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
              new_html += '<th style="text-align:center;">Classe</th>';
              new_html += '<th style="text-align:center;">Ordre</th>';
              new_html += '<th style="text-align:center;">Famille</th>';
              new_html += '<th style="text-align:center;">Sous-Famille</th>';
              new_html += '<th style="text-align:center;">Genre</th>';
              new_html += '<th style="text-align:center;">Espece</th>';
              new_html += '<th style="text-align:center;">Photo</th>';
              new_html += '<th style="text-align:center;">Modifier</th>';
              new_html += '</tr>';
              for (var i = 0; i < ret.resultat.length; i++) {
                  new_html += '<tr>';
                  new_html += '<td>' + ret.resultat[i].classe + '</td>';
                  new_html += '<td>' + ret.resultat[i].ordre + '</td>';
                  new_html += '<td>' + ret.resultat[i].famille + '</td>';
                  new_html += '<td>' + ret.resultat[i].sousFamille + '</td>';
                  new_html += '<td>' + ret.resultat[i].genre + '</td>';
                  new_html += '<td>' + ret.resultat[i].espece + '</td>';
                  if(ret.resultat[i].photo!=null){
                    new_html += '<td><a href="'+ret.resultat[i].photo+'" onclick="window.open(this.href, \'newwindow\',\'width=300,height=250\'); return false;"><img height="50px" width="50px" src="' + ret.resultat[i].photo + '"/></a></td>';
                  }
                  else{
                      new_html += '<td></td>';
                    }

                  new_html += '<td> Modifier</td>';
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


  function listeGene() {

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
              new_html += '<th style="text-align:center;">Nom du gene</th>';
              new_html += '<th style="text-align:center;">Modifier</th>';
              new_html += '<th style="text-align:center;">Supprimer</th>';
              new_html += '</tr>';
              for (var i = 0; i < ret.resultat.length; i++) {
                  new_html += '<tr>';
                  new_html += '<td>' + ret.resultat[i].nom + '</td>';

                  new_html += "<td><form method='GET' action='modifGene.php'>";
                  new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].nom+"' />";
                  new_html += "<input type='submit' value='Modifier' />";
                  new_html += "</form></td>";
              //new_html += ('<td><a href="">'."Modifier".'</a></td>');
                  new_html += "<td><form method='GET' onsubmit='return suppression(this)'>";
                  new_html += "<input type='hidden' name='nom' value='"+ret.resultat[i].nom+"' />";
                  new_html += "<input type='hidden' name='table' value='gene' />";
                  new_html += "<input type='hidden' name='colonne' value='nom' />";
                  new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].nom+"' />";
                  new_html += "<input type='submit' value='Supprimer' />";
                  new_html += "</form></td>";
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


  function listeSystemeHydro() {

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
              new_html += '<th style="text-align:center;">Nom</th>';
              new_html += '<th style="text-align:center;">departement</th>';
              new_html += '<th style="text-align:center;">Pays</th>';
              new_html += '</tr>';
              for (var i = 0; i < ret.resultat.length; i++) {
                  new_html += '<tr>';
                  new_html += '<td>' + ret.resultat[i].nom + '</td>';
                  new_html += '<td>' + ret.resultat[i].departement + '</td>';
                  new_html += '<td>' + ret.resultat[i].pays + '</td>';

                  new_html += "<td><form method='GET' action='modifSystemeHydrographique.php'>";
                  new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].id+"' />";
                  new_html += "<input type='submit' value='Modifier' />";
                  new_html += "</form></td>";
              //new_html += ('<td><a href="">'."Modifier".'</a></td>');
                  new_html += "<td><form method='GET' onsubmit='return suppression(this)'>";
                  new_html += "<input type='hidden' name='nom' value='"+ret.resultat[i].nom+" "+ret.resultat[i].departement+" "+ret.resultat[i].pays+"' />";
                  new_html += "<input type='hidden' name='table' value='systemehydrographique' />";
                  new_html += "<input type='hidden' name='colonne' value='id' />";
                  new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].id+"' />";
                  new_html += "<input type='submit' value='Supprimer' />";
                  new_html += "</form></td>";

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


  function listeEquipeSpelo() {

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
              new_html += '<th style="text-align:center;">Code Equipe</th>';
              new_html += '<th style="text-align:center;">Modifier</th>';
              new_html += '</tr>';
              for (var i = 0; i < ret.resultat.length; i++) {
                  new_html += '<tr>';
                  new_html += '<td>' + ret.resultat[i].codeEquipe + '</td>';
                  new_html += "<td><form method='GET' action='modifEquipeSpeleo.php'>";
                  new_html += "<input type='hidden' name='codeEquipe' value='"+ret.resultat[i].codeEquipe+"' />";
                  new_html += "<input type='submit' value='Modifier' />";
                  new_html += "</form></td>";

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

  function listePersonne() {

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
              new_html += '<th style="text-align:center;">Initiales</th>';
              new_html += '<th style="text-align:center;">Modifier</th>';
              new_html += '</tr>';
              for (var i = 0; i < ret.resultat.length; i++) {
                  new_html += '<tr>';
                  new_html += '<td>' + ret.resultat[i].initiale + '</td>';
                  new_html += "<td><form method='GET' action='modifPersonne.php'>";
                  new_html += "<input type='hidden' name='id' value='"+ret.resultat[i].id+"' />";
                  new_html += "<input type='submit' value='Modifier' />";
                  new_html += "</form></td>";

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

    var divFiltre=document.getElementById("divFiltre");
    var divFiltreGrotte=document.getElementById("divFiltreGrotte");
    var divFiltreSite=document.getElementById("divFiltreSite");
    var divFiltrePiege=document.getElementById("divFiltrePiege");

    select.addEventListener("change",function(){
      if(select.value=="Site" || select.value=="Piege" || select.value=="Echantillon"  ){
        divFiltre.style.display="block";
        if (select.value=="Echantillon"){
          divFiltreGrotte.style.display="inline-block";
          divFiltreSite.style.display="inline-block";
          divFiltrePiege.style.display="inline-block";
        }
        if (select.value=="Piege"){
          divFiltreGrotte.style.display="inline-block";
          divFiltreSite.style.display="inline-block";
          divFiltrePiege.style.display="none";
        }
        if (select.value=="Site"){
          divFiltreGrotte.style.display="inline-block";
          divFiltreSite.style.display="none";
          divFiltrePiege.style.display="none";
        }
      }
      else{
        divFiltre.style.display="none";
      }
    });




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
    if(select.value=="Taxonomie"){
    listeTaxonomie();
    }
    if(select.value=="Gene"){
    listeGene();
    }
    if(select.value=="SystemeHydrographique"){
    listeSystemeHydro();
    }
    if(select.value=="EquipeSpeleo"){
    listeEquipeSpelo();
    }
    if(select.value=="Personne"){
    listePersonne();
    }

    })





})
