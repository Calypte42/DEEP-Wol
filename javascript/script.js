// fonction qui necessite :
// url : url du webservice
// idAffichage : id de la division contenant le formulaire supplementaire
// idFormulaire : id du formulaire supplementaire
// idSelect : id du select concerne par la modification dans le formulaire principal
// idBouton : id du bouton qui fait apparaitre le formulaire supplementaire
// IMPORTANT : dans le cas où le formulaire contient plusieurs valeurs, veuillez
// ajouter à chaque input la classe 'valeurs'

function ajaxAjout(url, idAffichage, idFormulaire, idSelect, idBouton) {

    var liste = document.getElementById(idSelect);
    var listeOptions = liste.options;
    var formulaire = document.getElementById(idFormulaire);
    var valeurs = formulaire.getElementsByClassName('valeurs');
    var nouvelleOption = "";

    for (var i = 0; i < valeurs.length; i++) {
        nouvelleOption += valeurs[i].value;
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
                if (this.responseText) {
                    valeur = this.responseText;
                    var option = document.createElement("option");
                    option.text = nouvelleOption;
                    option.value = valeur;
                    option.selected = true;
                    liste.add(option, liste[0]);
                }
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

function suppression(formulaire) {
    var table = formulaire.elements['table'].value;
    var nom = formulaire.elements['nom'].value;
    var texte = '';

    if (table == 'grotte') {
        texte += "Souhaitez vous vraiment supprimer la grotte : " + nom;
        texte += "\nCETTE ACTION SUPPRIMERA EGALEMENT LES ELEMENTS LIES A LA GROTTE :\n"
        texte += "sites, pièges, échantillons, analyses";
    } else if (table == 'site') {
        texte = "Souhaitez vous vraiment supprimer le site : " + nom;
        texte += "\nCETTE ACTION SUPPRIMERA EGALEMENT LES ELEMENTS LIES AU SITE :\n"
        texte += "pièges, échantillons, analyses";
    } else if (table == 'piege') {
        texte += "Souhaitez vous vraiment supprimer le piege : " + nom;
        texte += "\nCETTE ACTION SUPPRIMERA EGALEMENT LES ELEMENTS LIES AU PIEGE :\n"
        texte += "échantillons, analyses";
    } else if (table == 'echantillon') {
        texte += "Souhaitez vous vraiment supprimer l'échantillon : " + nom;
        texte += "\nCETTE ACTION SUPPRIMERA EGALEMENT LES ELEMENTS LIES A L'ECHANTILLON :\n"
        texte += "analyses";
    } else if (table == 'qPCR' || table == 'PCR') {
        texte += "Souhaitez vous vraiment supprimer l'analyse ?";
    }

    if (confirm(texte)) {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                location.reload(true);
            }
        };

        request.open("POST", "./WebService/suppressionWS.php", true);
        request.send(new FormData(formulaire));
    }

    return false;
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

function controleAnalyse(formulaire) {

    if (formulaire.elements['fasta'].value) {

        nomFASTA = formulaire.elements['fasta'].files[0].name;
        check = urlExists("./files/fasta/" + nomFASTA);

        if (check) {
            alert("Nom de fichier fasta déjà existant, veuillez renommer votre fichier");
            return false;
        } else {
            return true;
        }
    }

    if (formulaire.elements['electrophoregramme'].value) {
        nomElectrophoregramme = formulaire.elements['electrophoregramme'].files[0].name;
        check = urlExists("./files/electrophoregramme/" + nomElectrophoregramme);

        if (check) {
            alert("Nom d'electrophoregramme déjà existant, veuillez renommer votre fichier");
            return false;
        } else {
            return true;
        }
    }

}

function urlExists(url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status != 404;
}
