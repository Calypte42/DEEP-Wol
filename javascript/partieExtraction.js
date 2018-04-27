document.addEventListener('DOMContentLoaded', function() {
function cocher(id) {
  var inputs = document.getElementById(id).getElementsByTagName('input');
  for(i = 0; i < inputs.length; i++) {
    if(inputs[i].type == 'checkbox')
      inputs[i].checked = "true";
  }
};

function decocher(id) {
  var inputs = document.getElementById(id).getElementsByTagName('input');
  for(i = 0; i < inputs.length; i++) {
    if(inputs[i].type == 'checkbox')
      inputs[i].checked = false;
  }
};

var menuSelectionType = document.getElementById('choixExtraction');


menuSelectionType.addEventListener("change",function(){
  var disparaitreSiFasta = document.getElementById('disparaitreSiFasta');
  var boutonFasta = document.getElementById('extraireFasta');
  var boutonCSV = document.getElementById('extraireCSV');
  if(menuSelectionType.value=='Fasta'){
    disparaitreSiFasta.style.display='none';
    boutonFasta.style.display='block';
    boutonCSV.style.display='none';
  }
  else{
    disparaitreSiFasta.style.display='inline';
    boutonFasta.style.display='none';
    boutonCSV.style.display='block';
  }
})

var toutCocherGeneral = document.getElementById('boutonToutSelectionner');
var toutDecocherGeneral = document.getElementById('boutonToutDeselectionner');
var toutCocherGrotte = document.getElementById('selectionGrotte');
var toutDecocherGrotte = document.getElementById('deselectionGrotte');
var toutCocherSite = document.getElementById('selectionSite');
var toutDecocherSite = document.getElementById('deselectionSite');
var toutCocherPiege = document.getElementById('selectionPiege');
var toutDecocherPiege = document.getElementById('deselectionPiege');
var toutCocherEchantillon = document.getElementById('selectionEchantillon');
var toutDecocherEchantillon = document.getElementById('deselectionEchantillon');

toutCocherGeneral.addEventListener("click",function(){

  cocher('disparaitreSiFasta');
});

toutDecocherGeneral.addEventListener("click",function(){

  decocher('disparaitreSiFasta');
});

toutCocherEchantillon.addEventListener("click",function(){

  cocher('divCheckEchantillon');
});

toutDecocherEchantillon.addEventListener("click",function(){

  decocher('divCheckEchantillon');
});

toutCocherPiege.addEventListener("click",function(){

  cocher('divCheckPiege');
});

toutDecocherPiege.addEventListener("click",function(){

  decocher('divCheckPiege');
});

toutCocherSite.addEventListener("click",function(){

  cocher('divCheckSite');
});

toutDecocherSite.addEventListener("click",function(){

  decocher('divCheckSite');
});

toutCocherGrotte.addEventListener("click",function(){

  cocher('divCheckGrotte');
});

toutDecocherGrotte.addEventListener("click",function(){

  decocher('divCheckGrotte');
});


})
