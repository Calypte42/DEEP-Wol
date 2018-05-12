document.addEventListener('DOMContentLoaded', function() {



function chargerImage(){


}
  var select = document.getElementById('choixType');
  var div = document.getElementById('disparaitreSiIndividu');
  var divBacterie= document.getElementById('apparaitreSiInfecteBacterie');

  var selectInfecteBacterie = document.getElementById('infecteBacterie');

  selectInfecteBacterie.addEventListener('change',function(){
    if(selectInfecteBacterie.value=="oui"){
      divBacterie.style.display="block";
    }
    else{
      divBacterie.style.display="none";
    }
  });

  select.addEventListener('change',function(){
    if (select.value=="Individu"){
      div.style.display='none';
    }
    else{
      div.style.display='inline';
    }
});


var classe = document.getElementById('classe');
var ordre = document.getElementById('ordre');
var famille = document.getElementById('famille');
var sousFamille = document.getElementById('sousFamille');
var genre = document.getElementById('genre');
var espece = document.getElementById('espece');
var imageTaxo = document.getElementById('imageTaxo');
var lienImageTaxo = document.getElementById('lienImageTaxo');



function chargerImage(){
  console.log("chargerImage");
  var request = new XMLHttpRequest(); // on prepare AJAX

  request.addEventListener('load', function(data) { // Quand la requete sera envoye on affichera
    console.log(data.target.responseText);
    var ret = JSON.parse(data.target.responseText); // le resultat de la requete sous forme de tableau
    var new_html = '';
    console.log(ret.resultat.length);
    if (ret.resultat.length != 0) {
      if(ret.resultat[0].photo!=null){
      lienImageTaxo.href=ret.resultat[0].photo;
      imageTaxo.src=ret.resultat[0].photo;
    }}

  });
  var requeteSelect="WebService/recherchePhotoWS.php?classe="+classe.value+"&ordre="+ordre.value+"&famille="+famille.value+"&sousFamille="+sousFamille.value+"&genre="+genre.value+"&espece="+espece.value;
  console.log(requeteSelect);
  request.open("POST", "./WebService/recherchePhotoWS.php"); // on envoie la requete
  var donnee = new FormData();
  donnee.append("classe",classe.value);
  donnee.append("ordre",ordre.value);
  donnee.append("famille",famille.value);
  donnee.append("sousFamille",sousFamille.value);
  donnee.append("genre",genre.value);
  donnee.append("espece",espece.value);
  request.send(donnee);


};

classe.addEventListener("change",function(){
  chargerImage();
});
ordre.addEventListener("change",function(){
  chargerImage();
});
famille.addEventListener("change",function(){
  chargerImage();
});
sousFamille.addEventListener("change",function(){
  chargerImage();
});
genre.addEventListener("change",function(){
  chargerImage();
});
espece.addEventListener("change",function(){
  chargerImage();
});




})
