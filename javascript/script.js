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

function ajoutBacterie(idAffichage, idFormulaire, idSelect, idBouton) {

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
        var option = document.createElement("option");
        option.text = nouvelleOption;
        option.value = nouvelleOption;
        option.selected = true;
        liste.add(option, liste[0]);
    }

    affichageDiv(idAffichage, idBouton);

    return false;

};

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

function verifIdentiqueTaxo(formulaire) {

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

    request.open("POST", "./WebService/verifIdentiqueTaxoWS.php", false);
    request.send(new FormData(formulaire));

    return verif;
}

function verifIdentiqueSystemeHydro(formulaire) {
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

    request.open("POST", "./WebService/verifIdentiqueSystemeHydroWS.php", false);
    request.send(new FormData(formulaire));

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
    } else if (table == 'analyses') {
        texte += "Souhaitez vous vraiment supprimer l'analyse ?";
    } else if (table == 'gene') {
        texte += "Souhaitez vous vraiment supprimer le gène : " + nom;
        texte += "\nCETTE ACTION SUPPRIMERA EGALEMENT LES ELEMENTS LIES AU GENE :\n"
        texte += "analyses";
    } else if (table == 'systemehydrographique') {
        texte += "Souhaitez vous vraiment supprimer le système hydrographique : " + nom;
        texte += "\nCETTE ACTION SUPPRIMERA EGALEMENT LES ELEMENTS LIES AU SYSTEME HYDROGRAPHIQUE :\n"
        texte += "grottes, sites, pièges, échantillons, analyses";
    } else if (table == 'equipespeleo') {
        texte += "Souhaitez vous vraiment supprimer l'équipe de spéléographique' : " + nom;
        texte += "\nCETTE ACTION SUPPRIMERA EGALEMENT LES ELEMENTS LIES A L'EQUIPE SPELEO :\n"
        texte += "sites, pièges, échantillons, analyses";
    } else if (table == 'personne') {
        texte += "Souhaitez vous vraiment supprimer la personne : " + nom;
        texte += "\nCETTE ACTION SUPPRIMERA EGALEMENT LES ELEMENTS LIES A CETTE PERSONNE :\n"
        texte += "échantillons, analyses";
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

function controleAnalyse(formulaire, modif) {

    if (formulaire.elements['fasta'].value) {

        nomFASTA = formulaire.elements['fasta'].files[0].name;

        if (modif) {
            nomFASTAPrecedent = formulaire.elements['nomFASTAPrecedent'].value;
            if (!(nomFASTA == nomFASTAPrecedent)) {
                check = urlExists("./files/fasta/" + nomFASTA);

                if (check) {
                    alert("Nom de fichier fasta déjà existant, veuillez renommer votre fichier");
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            check = urlExists("./files/fasta/" + nomFASTA);

            if (check) {
                alert("Nom de fichier fasta déjà existant, veuillez renommer votre fichier");
                return false;
            } else {
                return true;
            }
        }

    }

    if (formulaire.elements['electrophoregramme'].value) {
        nomElectrophoregramme = formulaire.elements['electrophoregramme'].files[0].name;

        if (modif) {
            nomElectroPrecedent = formulaire.elements['nomElectroPrecedent'].value;
            if (!(nomElectrophoregrammet == nomElectroPrecedent)) {

                check = urlExists("./files/electrophoregramme/" + nomElectrophoregramme);

                if (check) {
                    alert("Nom d'electrophoregramme déjà existant, veuillez renommer votre fichier");
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            check = urlExists("./files/electrophoregramme/" + nomElectrophoregramme);

            if (check) {
                alert("Nom d'electrophoregramme déjà existant, veuillez renommer votre fichier");
                return false;
            } else {
                return true;
            }
        }
    }

}

function controleGrotte(formulaire, modif) {
    select = formulaire.elements['systemeHydro'];
    message = "";
    erreur = false;

    if (select.value == "") {
        message += "- Veuillez choisir un système hydrographique\n";
        erreur = true;
    }

    valeurNomCavite = formulaire.elements['nomGrotte'].value;
    if (modif) {
        nomCavitePrecedent = formulaire.elements['nomCavitePrecedent'].value;
        if (!(nomCavitePrecedent == valeurNomCavite)) {
            if (verifIdentique('nomcavite', 'grotte', valeurNomCavite)) {
                message += "- Le nom de la grotte est déjà utilisée pour une autre grotte\n";
                erreur = true;
            }
        }
    } else {
        if (verifIdentique('nomcavite', 'grotte', valeurNomCavite)) {
            message += "- Le nom de la grotte est déjà utilisée pour une autre grotte\n";
            erreur = true;
        }
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

function controleSite(formulaire, modif) {
    select = formulaire.elements['codeEquipeSpeleo'];
    message = "";
    erreur = false;

    valeuridGrotte = formulaire.elements['idGrotteForm'].value;
    valeurNumSite = formulaire.elements['numSite'].value;
    valeurCodeEquipe = formulaire.elements['codeEquipeSpeleo'].value;

    if (modif) {
        numSitePrecedent = formulaire.elements['numSitePrecedent'].value;
        codeEquipePrecedent = formulaire.elements['codeEquipePrecedent'].value;
        if (!(valeurNumSite == numSitePrecedent && codeEquipePrecedent == valeurCodeEquipe)) {
            if (verifIdentiqueSitePiege(valeuridGrotte, valeurNumSite, valeurCodeEquipe, "site")) {
                message += "- Il existe déjà un site du même nom dans la grotte pour l'équipe choisie";
                erreur = true;
            }
        }
    } else {
        if (verifIdentiqueSitePiege(valeuridGrotte, valeurNumSite, valeurCodeEquipe, "site")) {
            message += "- Il existe déjà un site du même nom pour la grotte et l'équipe choisies";
            erreur = true;
        }
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

function controlePiege(formulaire, modif) {
    select = formulaire.elements['idGrotteForm'];
    select2 = formulaire.elements['codeEquipeSpeleo'];
    message = "";
    erreur = false;

    //valeuridSite = formulaire.elements['idSiteForm'].value;
    valeurCodePiege = formulaire.elements['codePiege'].value;
    //valeurCodeEquipe = formulaire.elements['codeEquipeSpeleo'].value;

    if (modif) {
        codePiegePrecedent = formulaire.elements['codePiegePrecedent'].value;
        //codeEquipePrecedent = formulaire.elements['codeEquipePrecedent'].value;
        if (!(valeurCodePiege == codePiegePrecedent)) {
            if (verifIdentique('codepiege', 'piege', valeurCodePiege)) {
                message += "- Il existe déjà un piège du même nom de code dans la base de données\n";
                erreur = true;
            }
        }
    } else {
        if (verifIdentique('codepiege', 'piege', valeurCodePiege)) {
            message += "- Il existe déjà un code de piège du même nom de code dans la base de données\n";
            erreur = true;
        }
    }

    if (select.value == "") {
        message += "- Veuillez choisir une grotte\n";
        erreur = true;
    }

    if (select2.value == "") {
        message += "- Veuillez choisir une équipe spéleo\n";
        erreur = true;
    }

    if (formulaire.elements['idSiteForm']) {
        select = formulaire.elements['idSiteForm'];
        if (select.value == "") {
            message += "- Veuillez choisir un site\n";
            erreur = true;
        }
    }

    if (!modif) {
        ajoutSite = formulaire.elements['ajoutSite'];
        if (ajoutSite.value != '') {
            message += "- Veuillez ajouter un site\n";
            erreur = true;
        }
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
        if (dateRecup.value != "" && dateTri.value < dateRecup.value) {
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

function controleEchantillon(formulaire) {
    message = "";
    erreur = false;

    valeurNumEchantillon = formulaire.elements['numEchantillon'].value;
    if (verifIdentique('numechantillon', 'echantillon', valeurNumEchantillon)) {
        message += "- Le numéro d'échantillon est déjà utilisé\n";
        erreur = true;
    }

    select2 = formulaire.elements['idGrotteForm'];
    if (select2.value == "") {
        message += "- Veuillez choisir une grotte\n";
        erreur = true;
    }

    if (formulaire.elements['idSiteForm']) {
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

    ajoutPiege = formulaire.elements['ajoutPiege'];
    if (ajoutPiege.value != '') {
        message += "- Veuillez ajouter un piège\n";
        erreur = true;
    }

    selectForme = formulaire.elements['formeStockage'];
    if (selectForme.value == "") {
        message += "- Veuillez choisir une forme de stockage\n";
        erreur = true;
    }

    selectLieu = formulaire.elements['lieuStockage'];
    if (selectLieu.value == "") {
        message += "- Veuillez choisir un lieu de stockage\n";
        erreur = true;
    }


    if (document.getElementById("divBacterie").style.display == "inline") {
        message += "Veuillez valider l'ajout d'une bactérie";
        erreur = true;
    }

    if (document.getElementById("infecteBacterie").value == "oui") {

        bacterie = document.getElementById("bacterie").options;
        compteur = 0;
        for (var i = 0; i < bacterie.length; i++) {
            if (bacterie[i].selected) {
                compteur += 1;
            }
        }

        if (compteur == 0) {
            message += "- Veuillez choisir au moins un gène\n";
            erreur = true;
        }
    }

    classe = formulaire.elements['classe'];
    if (classe.value == "") {
        message += "- Veuillez choisir une classe\n";
        erreur = true;
    }

    ordre = formulaire.elements['ordre'];
    if (classe.value == "") {
        message += "- Veuillez choisir un ordre\n";
        erreur = true;
    }

    famille = formulaire.elements['famille'];
    if (famille.value == "") {
        message += "- Veuillez choisir une famille\n";
        erreur = true;
    }

    sousFamille = formulaire.elements['sousFamille'];
    if (sousFamille.value == "") {
        message += "- Veuillez choisir une sous famille\n";
        erreur = true;
    }

    genre = formulaire.elements['genre'];
    if (genre.value == "") {
        message += "- Veuillez choisir un genre\n";
        erreur = true;
    }

    espece = formulaire.elements['espece'];
    if (espece.value == "") {
        message += "- Veuillez choisir une espèce\n";
        erreur = true;
    }

    select = formulaire.elements['idAuteur'];
    if (select.value == "") {
        message += "- Veuillez choisir un auteur\n";
        erreur = true;
    }

    if (document.getElementById("divPersonne").style.display == "inline") {
        message += "Veuillez valider l'ajout d'une personne";
        erreur = true;
    }

    if (erreur) {
        alert(message);
        return false;
    }

    return true;
}

function controleGene(formulaire, modif) {
    input = formulaire.elements['nomGene'];
    message = "";
    erreur = false;

    valeurNomGene = input.value;
    if (modif) {
        nomGenePrecedent = formulaire.elements['nomGenePrecedent'];
        if (!(nomGenePrecedent == valeurNomGene)){
            if (verifIdentique('nom', 'gene', valeurNomGene)) {
                message += "- Un gène du même nom existe déjà\n";
                erreur = true;
            }
        }
    } else {
        if (verifIdentique('nom', 'gene', valeurNomGene)) {
            message += "- Un gène du même nom existe déjà\n";
            erreur = true;
        }
    }

    if (erreur) {
        alert(message);
        return false;
    }

    return true;
}

function controleTaxo(formulaire) {
    message = "";
    erreur = false;

    if (formulaire.elements['photo'].value) {

        nomPhoto = formulaire.elements['photo'].files[0].name;
        check = urlExists("./files/photo/" + nomPhoto);

        if (check) {
            message += "- Nom de fichier déjà existant, veuillez renommer votre fichier\n";
            erreur = true;
        }
    }

    if (verifIdentiqueTaxo(formulaire)) {
        message += "- La taxonomie est déjà présente";
        erreur = true;
    }

    if (erreur) {
        alert(message);
        return false;
    }

    return true;
}

function controleSystemeHydro(formulaire) {
    message = "";
    erreur = false;

    nom = formulaire.elements['nom'].value;
    departement = formulaire.elements['departement'].value;
    pays = formulaire.elements['pays'].value;

    nomPrecedent = formulaire.elements['nomPrecedent'].value;
    departementPrecedent = formulaire.elements['departementPrecedent'].value;
    paysPrecedent = formulaire.elements['paysPrecedent'].value;

    if (!((nomPrecedent == nom) && (departementPrecedent == departement)
                                && (paysPrecedent == pays))) {
        if (verifIdentiqueSystemeHydro(formulaire)) {
            message += "- Il existe déjà un système hydrographique du même nom, département et pays\n";
            erreur = true;
        }
    }

    if (erreur) {
        alert(message);
        return false;
    }

    return true;
}

function controlePersonne(formulaire) {
    input = formulaire.elements['nomPersonne'];
    message = "";
    erreur = false;

    valeurNomPersonne = input.value;
    nomPersonnePrecedente = formulaire.elements['initialesPersonnePrecedente'];
    if (!(nomPersonnePrecedente == valeurNomPersonne)){
        if (verifIdentique('initiale', 'personne', valeurNomPersonne)) {
            message += "- Les initiales existent déjà";
            erreur = true;
        }
    }

    if (erreur) {
        alert(message);
        return false;
    }

    return true;
}

function controleEquipeSpeleo(formulaire) {
    input = formulaire.elements['codeEquipe'];
    message = "";
    erreur = false;

    valeurCodeEquipe = input.value;
    codeEquipePrecedent = formulaire.elements['codeEquipePrecedent'];
    if (!(codeEquipePrecedent == valeurCodeEquipe)){
        if (verifIdentique('codeEquipe', 'EquipeSpeleo', valeurCodeEquipe)) {
            message += "- Le code équipe existe déjà";
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
