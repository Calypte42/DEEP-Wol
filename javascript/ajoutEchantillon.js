document.addEventListener('DOMContentLoaded', function() {

    var select = document.getElementById('choixType');
    var div = document.getElementById('disparaitreSiIndividu');
    var divBacterie = document.getElementById('apparaitreSiInfecteBacterie');

    var selectInfecteBacterie = document.getElementById('infecteBacterie');

    selectInfecteBacterie.addEventListener('change', function() {
        if (selectInfecteBacterie.value == "oui") {
            divBacterie.style.display = "block";
        } else {
            divBacterie.style.display = "none";
        }
    });

    select.addEventListener('change', function() {
        if (select.value == "Individu") {
            div.style.display = 'none';
            document.getElementById('nombreIndividu').required = false;
        } else {
            div.style.display = 'inline';
            document.getElementById('nombreIndividu').required = true;
        }
    });


    var classe = document.getElementById('classe');
    var ordre = document.getElementById('ordre');
    var famille = document.getElementById('famille');
    var sousFamille = document.getElementById('sousFamille');
    var genre = document.getElementById('genre');
    var espece = document.getElementById('espece');
    var imageTaxo = document.getElementById('imageTaxo');
    var lienImageTaxo = document.getElementById('lienImageTaxo');

    function ajaxMajTaxo(rang) {
        rangModifie = document.getElementById(rang).value;

        var donnees = new FormData();

        if (classe.value) {
            donnees.append("classe", classe.value);
        } else {
            donnees.append("classe", "");
        }

        if (ordre.value) {
            donnees.append("ordre", ordre.value);
        } else {
            donnees.append("ordre", "");
        }

        if (famille.value) {
            donnees.append("famille", famille.value);
        } else {
            donnees.append("famille", "");
        }

        if (sousFamille.value) {
            donnees.append("sousFamille", sousFamille.value);
        } else {
            donnees.append("sousFamille", "");
        }

        if (genre.value) {
            donnees.append("genre", genre.value);
        } else {
            donnees.append("genre", "");
        }

        if (espece.value) {
            donnees.append("espece", espece.value);
        } else {
            donnees.append("espece", "");
        }

        if (classe.value != "") {
            donnees.append("classeSelected", 1);
        } else {
            donnees.append("classeSelected", 0);
        }

        if (ordre.value != "") {
            donnees.append("ordreSelected", 1);
        } else {
            donnees.append("ordreSelected", 0);
        }

        if (famille.value != "") {
            donnees.append("familleSelected", 1);
        } else {
            donnees.append("familleSelected", 0);
        }

        if (sousFamille.value != "") {
            donnees.append("sousFamilleSelected", 1);
        } else {
            donnees.append("sousFamilleSelected", 0);
        }

        if (genre.value != "") {
            donnees.append("genreSelected", 1);
        } else {
            donnees.append("genreSelected", 0);
        }

        if (espece.value != "") {
            donnees.append("especeSelected", 1);
        } else {
            donnees.append("especeSelected", 0);
        }

        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText) {
                    json = JSON.parse(this.responseText);
                    taxoSelect = ["classe", "ordre", "famille", "sousFamille", "genre", "espece"];
                    x = 0
                    multiple = false;

                    for (taxo in json) {
                        select = document.getElementById(taxoSelect[x]);
                        valeur = select.value;
                        select.options.length = 0;

                        var option = document.createElement("option");
                        option.text = "";
                        option.value = "";
                        select.add(option);

                        liste = json[taxo];

                        if (!(liste == null)) {

                            nombreValeurs = Object.keys(liste).length;
                            for (var i = 0; i < liste.length; i++) {
                                if (liste[i] == "") {
                                    nombreValeurs --;
                                }
                            }

                            if (nombreValeurs > 1) {
                                multiple = true;
                            }

                            for (var i = 0; i < liste.length; i++) {
                                if (liste[i] == "") {
                                    var option = document.createElement("option");
                                    option.text = "Indetermine";
                                    option.value = "Indetermine";
                                    select.add(option, select[1]);
                                } else {
                                    var option = document.createElement("option");
                                    option.text = liste[i];
                                    option.value = liste[i];
                                    if ((valeur == liste[i]))
                                        option.selected = true;
                                    else if ((nombreValeurs == 1) && !multiple && (rangModifie != "Indetermine") && (rangModifie != ""))
                                        option.selected = true;
                                    select.add(option);
                                }
                            }
                        }

                        x += 1;
                    }

                }
            }
        };

        donnees.append("rang", rang);

        request.open("POST", "./WebService/listeTaxonomieWS.php");
        request.send(donnees);
    }

    function chargerImage() {
        console.log("chargerImage");
        var request = new XMLHttpRequest(); // on prepare AJAX

        request.addEventListener('load', function(data) { // Quand la requete sera envoye on affichera
            console.log(data.target.responseText);
            var ret = JSON.parse(data.target.responseText); // le resultat de la requete sous forme de tableau
            var new_html = '';
            console.log(ret.resultat.length);
            if (ret.resultat.length != 0) {
                if (ret.resultat[0].photo != null) {
                    lienImageTaxo.href = ret.resultat[0].photo;
                    lienImageTaxo.style = "";
                    imageTaxo.src = ret.resultat[0].photo;
                    imageTaxo.setAttribute("width", "200px");
                    imageTaxo.setAttribute("height", "200px");
                }
            } else {
                lienImageTaxo.style = "pointer-events: none;";
                lienImageTaxo.href = "";
                imageTaxo.setAttribute("alt", "Pas d'image disponible");
            }

        });
        var requeteSelect = "WebService/recherchePhotoWS.php?classe=" + classe.value + "&ordre=" + ordre.value + "&famille=" + famille.value + "&sousFamille=" + sousFamille.value + "&genre=" + genre.value + "&espece=" + espece.value;
        console.log(requeteSelect);
        request.open("POST", "./WebService/recherchePhotoWS.php"); // on envoie la requete
        var donnee = new FormData();
        donnee.append("classe", classe.value);
        donnee.append("ordre", ordre.value);
        donnee.append("famille", famille.value);
        donnee.append("sousFamille", sousFamille.value);
        donnee.append("genre", genre.value);
        donnee.append("espece", espece.value);
        request.send(donnee);

    };

    classe.addEventListener("change", function() {
        ajaxMajTaxo("classe");
        chargerImage();
    });
    ordre.addEventListener("change", function() {
        ajaxMajTaxo("ordre");
        chargerImage();
    });
    famille.addEventListener("change", function() {
        ajaxMajTaxo("famille");
        chargerImage();
    });
    sousFamille.addEventListener("change", function() {
        ajaxMajTaxo("sousFamille");
        chargerImage();
    });
    genre.addEventListener("change", function() {
        ajaxMajTaxo("genre");
        chargerImage();
    });
    espece.addEventListener("change", function() {
        ajaxMajTaxo("espece");
        chargerImage();
    });

})
