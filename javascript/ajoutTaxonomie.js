document.addEventListener('DOMContentLoaded', function() {
  var selectClasseTaxo = document.getElementById('selectClasseTaxo');
  var selectOrdreTaxo = document.getElementById('selectOrdreTaxo');
  var selectFamilleTaxo = document.getElementById('selectFamilleTaxo');
  var selectSousFamilleTaxo = document.getElementById('selectSousFamilleTaxo');
  var selectGenreTaxo = document.getElementById('selectGenreTaxo');
  var classeTaxo = document.getElementById('classeTaxo');
  var ordreTaxo = document.getElementById('ordreTaxo');
  var familleTaxo = document.getElementById('familleTaxo');
  var sousFamilleTaxo = document.getElementById('sousFamilleTaxo');
  var genreTaxo = document.getElementById('genreTaxo');
  var especeTaxo = document.getElementById('especeTaxo');

  selectClasseTaxo.addEventListener('change',function(){
    if(selectClasseTaxo.value=="Nouveau"){
      selectClasseTaxo.setAttribute('name','');
      classeTaxo.setAttribute('name','classeTaxo');
      classeTaxo.style.display='inline';
    }
    else{
      selectClasseTaxo.setAttribute('name','classeTaxo');
      classeTaxo.style.display='none';
      classeTaxo.setAttribute('name','');
    }
  });

  selectOrdreTaxo.addEventListener('change',function(){
    if(selectOrdreTaxo.value=="Nouveau"){
      selectOrdreTaxo.setAttribute('name','');
      ordreTaxo.setAttribute('name','ordreTaxo');
      ordreTaxo.style.display='inline';
    }
    else{
      selectOrdreTaxo.setAttribute('name','ordreTaxo');
      ordreTaxo.style.display='none';
      ordreTaxo.setAttribute('name','');
    }
  });

  selectFamilleTaxo.addEventListener('change',function(){
    if(selectFamilleTaxo.value=="Nouveau"){
      selectFamilleTaxo.setAttribute('name','');
      familleTaxo.setAttribute('name','familleTaxo');
      familleTaxo.style.display='inline';
    }
    else{
      selectFamilleTaxo.setAttribute('name','familleTaxo');
      familleTaxo.style.display='none';
      familleTaxo.setAttribute('name','');
    }
  });

  selectSousFamilleTaxo.addEventListener('change',function(){
    if(selectSousFamilleTaxo.value=="Nouveau"){
      selectSousFamilleTaxo.setAttribute('name','');
      sousFamilleTaxo.setAttribute('name','sousFamilleTaxo');
      sousFamilleTaxo.style.display='inline';
    }
    else{
      selectSousFamilleTaxo.setAttribute('name','sousFamilleTaxo');
      sousFamilleTaxo.style.display='none';
      sousFamilleTaxo.setAttribute('name','');
    }
  });

  selectGenreTaxo.addEventListener('change',function(){
    if(selectGenreTaxo.value=="Nouveau"){
      selectGenreTaxo.setAttribute('name','');
      genreTaxo.setAttribute('name','genreTaxo');
      genreTaxo.style.display='inline';
    }
    else{
      selectClasseTaxo.setAttribute('name','genreTaxo');
      genreTaxo.style.display='none';
      genreTaxo.setAttribute('name','');
    }
  });


});
