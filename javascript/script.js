// fonction qui necessite :
// url : url du webservice
// idAffichage : id de la division contenant le formulaire supplementaire
// idFormulaire : id du formulaire supplementaire
// idSelect : id du select concerne par la modification dans le formulaire principal
// nombreValeurs : IMPORTANT : correspond au nombre de valeurs à comparer avec
// le select du formulaire principal (dans le cas ou on a des attributs concatenes)
function ajaxAjout(url, idAffichage, idFormulaire, idSelect, nombreValeurs) {

    var liste = document.getElementById(idSelect);
    var formulaire = document.getElementById(idFormulaire);
    var nouvelleOption;

    for (var i = 0; i < nombreValeurs; i++) {
        nouvelleOption += formulaire.elements[i].value;
        nouvelleOption += " ";
    }

    nouvelleOption.trim();

    var ajoutOption = true;
    for (var option in liste.options) {
        if (option.text == nouvelleOption) {
            var ajoutOption = false;
            option.selected = true;
        }
    }

    if (ajoutOption) {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var option = document.createElement("option");

                option.text = nouvelleOption;
                option.selected = true;
                liste.add(option, liste[0]);

                affichageDiv(idAffichage);
            }
        };

        request.open("POST", url, true);
        request.send(new FormData(formulaire));
    }

    return false;

};

function affichageDiv(id) {

    var affichage = document.getElementById(id);

    if (affichage.style.display != "inline") {
        affichage.style.display = "inline";
    } else {
        affichage.style.display = "none";
    }

};
