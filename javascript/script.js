// fonction qui necessite :
// url : url du webservice
// idAffichage : id de la division contenant le formulaire supplementaire
// idFormulaire : id du formulaire supplementaire
// idSelect : id du select concerne par la modification dans le formulaire principal
// idBouton : id du bouton qui fait apparaitre le formulaire supplementaire
// nombreValeurs : IMPORTANT : correspond au nombre de valeurs à comparer avec
// le select du formulaire principal (dans le cas ou on a des attributs concatenes)
function ajaxAjout(url, idAffichage, idFormulaire, idSelect, idBouton, nombreValeurs) {

    var liste = document.getElementById(idSelect);
    var listeOptions = liste.options;
    var formulaire = document.getElementById(idFormulaire);
    var nouvelleOption = "";

    for (var i = 0; i < nombreValeurs; i++) {
        nouvelleOption += formulaire.elements[i].value;
        nouvelleOption += " ";
    }

    nouvelleOption = nouvelleOption.trim();

    var ajoutOption = true;
    for (var i = 0; i < listeOptions.length; i++) {
        if (listeOptions[i].text == nouvelleOption) {
            ajoutOption = false;
            listeOptions[i].selected = true;
        }
    }

    if (ajoutOption) {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var option = document.createElement("option");
                option.text = nouvelleOption;
                option.value = nouvelleOption;
                option.selected = true;
                liste.add(option, liste[0]);
            }
        };

        request.open("POST", url, true);
        request.send(new FormData(formulaire));
    }

    affichageDiv(idAffichage, idBouton);

    return false;

};

function afficher(idDiv, typeAffichage) {
    var affichage = document.getElementById(idDiv);
    affichage.style.display = typeAffichage;
}

function cacher(idDiv) {
    var affichage = document.getElementById(idDiv);
    affichage.style.display = "none";
}

function supprimerValeur(idInput) {
    document.getElementById(idInput).value = "";
}

function requis(idInput) {
    document.getElementById(idInput).required = true;
}

function nonRequis(idInput) {
    document.getElementById(idInput).required = false;
}

function affichageDiv(idDiv, idBouton) {

    var affichage = document.getElementById(idDiv);
    var bouton = document.getElementById(idBouton);

    if (affichage.style.display != "inline") {
        affichage.style.display = "inline";
        bouton.style.display = "none";
    } else {
        affichage.style.display = "none";
        bouton.style.display = "inline";
    }

};
