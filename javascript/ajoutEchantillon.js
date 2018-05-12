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

    function majTaxo(rang) {

        var donnees = new FormData();

        donnees.append("classe", classe.value);

        if ((rang + 1) == 1) {
            rangMAJ = "ordre";
            ajaxMajTaxo(rangMAJ, donnees);
        }

        donnees.append("ordre", ordre.value);

        if ((rang + 1) == 2) {
            rangMAJ = "famille";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 2) {
            famille.options.length = 0;
        }

        donnees.append("sousFamille", sousFamille.value);

        if ((rang + 1) == 3) {
            rangMAJ = "sousFamille";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 3) {
            sousFamille.options.length = 0;
        }

        donnees.append("famille", famille.value);

        if ((rang + 1) == 4) {
            rangMAJ = "genre";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 4) {
            genre.options.length = 0;
        }

        donnees.append("genre", genre.value);

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
        var request = new XMLHttpRequest(); // on prepare AJAX

        request.addEventListener('load', function(data) { // Quand la requete sera envoye on affichera
            var ret = JSON.parse(data.target.responseText); // le resultat de la requete sous forme de tableau
            var new_html = '';
            if (ret.resultat.length != 0) {
                imageTaxo.href = ret.resultat[0].photo;
            }

        });
        var requeteSelect = "WebService/recherchePhotoWS.php?classe=" + classe.value + "&ordre=" + ordre.value + "&famille=" + famille.value + "&sousFamille=" + sousFamille.value + "&genre=" + genre.value + "&espece=" + espece.value;
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
        majTaxo(5)
        chargerImage();
    });

})
