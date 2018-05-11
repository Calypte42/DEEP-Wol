// fonction qui necessite :
// url : url du webservice
// idAffichage : id de la division contenant le formulaire supplementaire
// idFormulaire : id du formulaire supplementaire
// idSelect : id du select concerne par la modification dans le formulaire principal
// idBouton : id du bouton qui fait apparaitre le formulaire supplementaire
// IMPORTANT : dans le cas où le formulaire contient plusieurs valeurs, veuillez
// ajouter à chaque input la classe 'valeurs'

function ajaxAjout(url, idAffichage, idFormulaire, idSelect) {

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
        if (listeOptions[i].text.trim() == nouvelleOption) {
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
                    liste.add(option, liste[1]);
                }
            }
        };

        request.open("POST", url, true);
        request.send(new FormData(formulaire));
    }

    cacher(idAffichage);

    return false;

};

function majSite(idGrotte, majPiege) {
    var request = new XMLHttpRequest();
    var selectDiv = document.getElementById('choixSite');

    if (selectDiv.style.display == 'none') {
        selectDiv.style.display = 'inline';
    }

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
                selectDiv.innerHTML = this.responseText;
            }
        }
    }
    request.open("GET", "./WebService/listeSiteWS.php?idGrotte=" + idGrotte +
                                                    "&majPiege=" + majPiege, true);
    request.send();
}

function majPiege(idSite) {
    var request = new XMLHttpRequest();
    var selectDiv = document.getElementById('choixPiege');

    if (selectDiv.style.display == 'none') {
        selectDiv.style.display = 'inline';
    }

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
                selectDiv.innerHTML = this.responseText;
            }
        }
    }
    request.open("GET", "./WebService/listePiegeWS.php?idSite=" + idSite, true);
    request.send();
}

function verifIdentique(nom, table, valeur) {

    var request = new XMLHttpRequest();
    var verif = false;

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
                verif = true;
            } else {
                verif = false;
            }
        }
    }

    request.open("GET", "./WebService/verifIdentiqueWS.php?nom=" + nom +
                                "&table=" + table + "&valeur=" + valeur, false);
    request.send();

    return verif;
}

function verifIdentiqueSitePiege(id, num, codeEquipe, type) {

    var request = new XMLHttpRequest();
    var verif = false;

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
                verif = true;
            } else {
                verif = false;
            }
        }
    }

    request.open("GET", "./WebService/verifIdentiqueSitePiegeWS.php?id=" + id +
                                "&num=" + num + "&codeEquipe=" + codeEquipe +
                                "&type=" + type, false);
    request.send();

    return verif;
}

function afficher(idDiv, typeAffichage) {
    var affichage = document.getElementById(idDiv);
    affichage.style.display = typeAffichage;
}

function cacher(idDiv) {
    var affichage = document.getElementById(idDiv);
    affichage.style.display = "none";
}

function cacherPiege() {
    var selectDiv = document.getElementById('choixPiege');
    selectDiv.style.display = 'none';
    selectDiv.innerHTML = "<input type='hidden' name='ajoutPiege' value='' />";
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

function ajoutAutre(valeurAutre, idDiv, idInput) {
    if (valeurAutre == 'autre') {
        document.getElementById(idDiv).style.display = "inline";
        document.getElementById(idInput).required = true;
    } else {
        document.getElementById(idDiv).style.display = "none";
        document.getElementById(idInput).required = false;
        document.getElementById(idInput).value = "";
    }
}

function ajoutDiv(valeurAutre, idDiv) {
    if (valeurAutre == 'autre') {
        document.getElementById(idDiv).style.display = "inline";
    } else {
        document.getElementById(idDiv).style.display = "none";
    }
}

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

function controleGrotte(formulaire) {
    select = formulaire.elements['systemeHydro'];
    message = "";
    erreur = false;

    if (select.value == "") {
        message += "- Veuillez choisir un système hydrographique\n";
        erreur = true;
    }

    valeurNomCavite = formulaire.elements['nomGrotte'].value;
    if (verifIdentique('nomcavite', 'grotte', valeurNomCavite)) {
        message += "- Le nom de la grotte est déjà utilisée pour une autre grotte\n";
        erreur = true;
    }

    if (document.getElementById("divSystemeHydrographique").style.display == "inline") {
        message += "- Veuillez valider l'ajout d'un système hydrographique";
        erreur = true;
    }

    if (erreur) {
        alert(message);
        return false;
    }

    return true;
}

function controleSite(formulaire) {
    select = formulaire.elements['codeEquipeSpeleo'];
    message = "";
    erreur = false;

    valeuridGrotte = formulaire.elements['idGrotteForm'].value;
    valeurNumSite = formulaire.elements['numSite'].value;
    valeurCodeEquipe = formulaire.elements['codeEquipeSpeleo'].value;
    if (verifIdentiqueSitePiege(valeuridGrotte, valeurNumSite, valeurCodeEquipe, "site")) {
        message += "- Il existe déjà un site du même nom pour la grotte et l'équipe choisies";
        erreur = true;
    }

    if (select.value == "") {
        message += "- Veuillez choisir une équipe spéleo\n";
        erreur = true;
    }

    if (document.getElementById("divEquipeSpeleo").style.display == "inline") {
        message += "Veuillez valider l'ajout d'une équipe spéleo";
        erreur = true;
    }

    if (erreur) {
        alert(message);
        return false;
    }

    return true;
}

function controlePiege(formulaire) {
    select = formulaire.elements['idGrotteForm'];
    select2 = formulaire.elements['codeEquipeSpeleo'];
    message = "";
    erreur = false;

    valeuridSite = formulaire.elements['idSiteForm'].value;
    valeurCodePiege = formulaire.elements['codePiege'].value;
    valeurCodeEquipe = formulaire.elements['codeEquipeSpeleo'].value;
    if (verifIdentiqueSitePiege(valeuridSite, valeurCodePiege, valeurCodeEquipe, "piege")) {
        message += "- Il existe déjà un code de piège du même nom pour la grotte, le site et l'équipe choisis";
        erreur = true;
    }

    if (select.value == "") {
        message += "- Veuillez choisir une grotte\n";
        erreur = true;
    }

    if (select2.value == "") {
        message += "- Veuillez choisir une équipe spéleo\n";
        erreur = true;
    }

    if(formulaire.elements['idSiteForm']) {
        select = formulaire.elements['idSiteForm'];
        if (select.value == "") {
            message += "- Veuillez choisir un site\n";
            erreur = true;
        }
    }

    ajoutSite = formulaire.elements['ajoutSite'];
    if (ajoutSite.value != '') {
        message += "- Veuillez ajouter un site\n";
        erreur = true;
    }

    datePose = formulaire.elements['datePose'];
    dateRecup = formulaire.elements['dateRecup'];
    heurePose = formulaire.elements['heurePose'];
    heureRecup = formulaire.elements['heureRecup'];
    if (dateRecup.value != "" && datePose.value != "") {
        if (dateRecup.value < datePose.value) {
            message += "- La date de pose doit être antérieure à la date de récupération\n";
            erreur = true;
        } else if (dateRecup.value == datePose.value) {
            if (heureRecup.value != "" && heurePose.value != "") {
                if (heureRecup.value < heurePose.value) {
                    message += "- L'heure de pose doit être antérieure à l'heure de récupération\n";
                    erreur = true;
                }
            }
        }
    }

    dateTri = formulaire.elements['dateTri'];
    if (dateTri.value != "") {
        if (dateRecup.value != "" && dateTri.value < dateRecup.value){
            message += "- La date de récupération doit être antérieure à la date de tri\n";
            erreur = true;
        }

        if (datePose.value != "" && dateTri.value < datePose.value) {
            message += "- La date de pose doit être antérieure à la date de tri";
            erreur = true;
        }
    }

    if (erreur) {
        alert(message);
        return false;
    }

    return true;

}

function urlExists(url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status != 404;
}
