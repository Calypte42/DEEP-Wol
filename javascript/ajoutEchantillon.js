document.addEventListener('DOMContentLoaded', function() {

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

})
