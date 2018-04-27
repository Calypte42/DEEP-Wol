document.addEventListener('DOMContentLoaded', function() {

  var select = document.getElementById('choixType');
  var div = document.getElementById('disparaitreSiIndividu');

  select.addEventListener('change',function(){
    if (select.value=="Individu"){
      div.style.display='none';
    }
    else{
      div.style.display='inline';
    }
});

})
