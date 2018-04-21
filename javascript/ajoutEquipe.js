document.addEventListener('DOMContentLoaded', function() {

    var affichageAjoutEquipe = document.getElementById('affichageAjoutEquipe')
    var form = document.getElementById('distanceEntree');

    affichageAjoutEquipe.addEventListener("click", function(event) {
        event.preventDefault()
        var affichage = document.getElementById('divEquipeSpeleo')
        affichage.style.display = "inline";
        form.style.display = "none";
    });


    var formAjoutEquipe = document.getElementById('formEquipeSpeleo')

    formAjoutEquipe.addEventListener("submit", function(event) {
        event.preventDefault()
        var request = new XMLHttpRequest()

        request.addEventListener('load', function(data) {
            reponse = data.target.responseText
            if (reponse==200) {
                var listeEquipeSpeleo = document.getElementById('listeEquipeSpeleo')
                var option = document.createElement("option")
                var codeEquipe = document.getElementById('codeEquipe')
                var listeOptions = listeEquipeSpeleo.options
                valeurCodeEquipe = codeEquipe.value

                var ajoutOption = true
                for (var i = 0; i < listeOptions.length; i++) {
                    if (listeOptions[i].text == valeurCodeEquipe) {
                        var ajoutOption = false
                        listeOptions[i].selected = true
                    }
                }

                if (ajoutOption) {
                    option.text = valeurCodeEquipe
                    option.selected = true
                    listeEquipeSpeleo.add(option, listeEquipeSpeleo[0])
                }

                var affichage = document.getElementById('divEquipeSpeleo')
                affichage.style.display = "none"
                form.style.display="inline";
            }
        });

        request.open("POST", "./WebService/ajoutEquipeWS.php")
        request.send(new FormData(this))
    });

})
