document.addEventListener('DOMContentLoaded', function() {

    var affichageAjoutEquipe = document.getElementById('affichageSystemeHydrographique')

    affichageAjoutEquipe.addEventListener("click", function(event) {
        event.preventDefault()
        var affichage = document.getElementById('divSystemeHydrographique')
        affichage.style.display = "inline"
    });


    var formAjoutEquipe = document.getElementById('formSystemeHydrographique')

    formAjoutEquipe.addEventListener("submit", function(event) {
        event.preventDefault()
        var request = new XMLHttpRequest()

        request.addEventListener('load', function(data) {
            reponse = data.target.responseText
            if (reponse==200) {
                var listeSystemeHydrographique = document.getElementById('listeSystemeHydrographique')
                var option = document.createElement("option")
                var nomSystemeHydro = document.getElementById('nom')
                var listeOptions = listeSystemeHydrographique.options
                valeurNomSystemeHydro = nomSystemeHydro.value

                var ajoutOption = true
                for (var i = 0; i < listeOptions.length; i++) {
                    if (listeOptions[i].text == valeurNomSystemeHydro) {
                        var ajoutOption = false
                        listeOptions[i].selected = true
                    }
                }

                if (ajoutOption) {
                    option.text = valeurNomSystemeHydro
                    option.selected = true
                    listeSystemeHydrographique.add(option, listeSystemeHydrographique[0])
                }

                var affichage = document.getElementById('divSystemeHydrographique')
                affichage.style.display = "none"
            }
        });

        request.open("POST", "ajoutSystemeHydrographiqueWS.php")
        request.send(new FormData(this))
    });

})
