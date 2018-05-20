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

    function majTaxo(rang) {

        var donnees = new FormData();

        if (classe.value) {
            donnees.append("classe", classe.value);
        } else {
            donnees.append("classe", "");
        }

        if ((rang + 1) == 1) {
            rangMAJ = "ordre";
            ajaxMajTaxo(rangMAJ, donnees);
        }

        if (ordre.value) {
            donnees.append("ordre", ordre.value);
        } else {
            donnees.append("ordre", "");
        }

        if ((rang + 1) == 2) {
            rangMAJ = "famille";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 2) {
            famille.options.length = 0;
        }

        if (famille.value) {
            donnees.append("famille", famille.value);
        } else {
            donnees.append("famille", "");
        }

        if ((rang + 1) == 3) {
            rangMAJ = "sousFamille";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 3) {
            sousFamille.options.length = 0;
        }

        if (sousFamille.value) {
            donnees.append("sousFamille", sousFamille.value);
        } else {
            donnees.append("sousFamille", "");
        }

        if ((rang + 1) == 4) {
            rangMAJ = "genre";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 4) {
            genre.options.length = 0;
        }

        if (genre.value) {
            donnees.append("genre", genre.value);
        } else {
            donnees.append("genre", "");
        }

        if ((rang + 1) == 5) {
            rangMAJ = "espece";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 5) {
            espece.options.length = 0;
        }

    }

    function ajaxMajTaxo(rang, donnees) {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText) {
                    select = document.getElementById(rang);
                    select.options.length = 0;

                    var option = document.createElement("option");

                    option.text = "Choisir";
                    option.value = "";
                    option.selected = true;
                    option.disabled = true;
                    select.add(option);

                    liste = JSON.parse(this.responseText);

                    if (!(liste == null)) {
                        for (var i = 0; i < liste.length; i++) {
                            var option = document.createElement("option");
                            option.text = liste[i];
                            option.value = liste[i];
                            select.add(option);
                        }
                    }

                    var option = document.createElement("option");
                    option.text = "Indetermine";
                    option.value = "Indetermine";
                    select.add(option);
                }
            }
        };

        donnees.append("rang", rang);

        request.open("POST", "./WebService/listeTaxonomieWS.php", true);
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
                imageTaxo.src="";
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
        majTaxo(0)
        chargerImage();
    });
    ordre.addEventListener("change", function() {
        majTaxo(1)
        chargerImage();
    });
    famille.addEventListener("change", function() {
        majTaxo(2)
        chargerImage();
    });
    sousFamille.addEventListener("change", function() {
        majTaxo(3)
        chargerImage();
    });
    genre.addEventListener("change", function() {
        majTaxo(4)
        chargerImage();
    });
    espece.addEventListener("change", function() {
        chargerImage();
    });

})
