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
  if(menuSelectionType.value=='Fasta'){
    disparaitreSiFasta.style.display='none';
  }
  else{
    disparaitreSiFasta.style.display='inline';
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
  event.preventDefault();
  cocher('disparaitreSiFasta');
});

toutDecocherGeneral.addEventListener("click",function(){
  event.preventDefault();
  decocher('disparaitreSiFasta');
});

toutCocherEchantillon.addEventListener("click",function(){
  event.preventDefault();
  cocher('divCheckEchantillon');
});

toutDecocherEchantillon.addEventListener("click",function(){
  event.preventDefault();
  decocher('divCheckEchantillon');
});

toutCocherPiege.addEventListener("click",function(){
  event.preventDefault();
  cocher('divCheckPiege');
});

toutDecocherPiege.addEventListener("click",function(){
  event.preventDefault();
  decocher('divCheckPiege');
});

toutCocherSite.addEventListener("click",function(){
  event.preventDefault();
  cocher('divCheckSite');
});

toutDecocherSite.addEventListener("click",function(){
  event.preventDefault();
  decocher('divCheckSite');
});

toutCocherGrotte.addEventListener("click",function(){
  event.preventDefault();
  cocher('divCheckGrotte');
});

toutDecocherGrotte.addEventListener("click",function(){
  event.preventDefault();
  decocher('divCheckGrotte');
});


})
