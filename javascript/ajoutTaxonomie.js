document.addEventListener('DOMContentLoaded', function() {
    var selectClasseTaxo = document.getElementById('selectClasseTaxo');
    var selectOrdreTaxo = document.getElementById('selectOrdreTaxo');
    var selectFamilleTaxo = document.getElementById('selectFamilleTaxo');
    var selectSousFamilleTaxo = document.getElementById('selectSousFamilleTaxo');
    var selectGenreTaxo = document.getElementById('selectGenreTaxo');
    var classeTaxo = document.getElementById('classeTaxo');
    var ordreTaxo = document.getElementById('ordreTaxo');
    var familleTaxo = document.getElementById('familleTaxo');
    var sousFamilleTaxo = document.getElementById('sousFamilleTaxo');
    var genreTaxo = document.getElementById('genreTaxo');
    var especeTaxo = document.getElementById('especeTaxo');

    selectClasseTaxo.addEventListener('change', function() {
        if (selectClasseTaxo.value == "Nouveau") {
            selectClasseTaxo.setAttribute('name', '');
            classeTaxo.setAttribute('name', 'classeTaxo');
            classeTaxo.style.display = 'inline';
        } else {
            selectClasseTaxo.setAttribute('name', 'classeTaxo');
            classeTaxo.style.display = 'none';
            classeTaxo.setAttribute('name', '');
        }
    });

    selectOrdreTaxo.addEventListener('change', function() {
        if (selectOrdreTaxo.value == "Nouveau") {
            selectOrdreTaxo.setAttribute('name', '');
            ordreTaxo.setAttribute('name', 'ordreTaxo');
            ordreTaxo.style.display = 'inline';
        } else {
            selectOrdreTaxo.setAttribute('name', 'ordreTaxo');
            ordreTaxo.style.display = 'none';
            ordreTaxo.setAttribute('name', '');
        }
    });

    selectFamilleTaxo.addEventListener('change', function() {
        if (selectFamilleTaxo.value == "Nouveau") {
            selectFamilleTaxo.setAttribute('name', '');
            familleTaxo.setAttribute('name', 'familleTaxo');
            familleTaxo.style.display = 'inline';
        } else {
            selectFamilleTaxo.setAttribute('name', 'familleTaxo');
            familleTaxo.style.display = 'none';
            familleTaxo.setAttribute('name', '');
        }
    });

    selectSousFamilleTaxo.addEventListener('change', function() {
        if (selectSousFamilleTaxo.value == "Nouveau") {
            selectSousFamilleTaxo.setAttribute('name', '');
            sousFamilleTaxo.setAttribute('name', 'sousFamilleTaxo');
            sousFamilleTaxo.style.display = 'inline';
        } else {
            selectSousFamilleTaxo.setAttribute('name', 'sousFamilleTaxo');
            sousFamilleTaxo.style.display = 'none';
            sousFamilleTaxo.setAttribute('name', '');
        }
    });

    selectGenreTaxo.addEventListener('change', function() {
        if (selectGenreTaxo.value == "Nouveau") {
            selectGenreTaxo.setAttribute('name', '');
            genreTaxo.setAttribute('name', 'genreTaxo');
            genreTaxo.style.display = 'inline';
        } else {
            selectGenreTaxo.setAttribute('name', 'genreTaxo');
            genreTaxo.style.display = 'none';
            genreTaxo.setAttribute('name', '');
        }
    });

    function majTaxo(rang) {

        var donnees = new FormData();

        donnees.append("classe", selectClasseTaxo.value);

        if ((rang + 1) == 1) {
            rangMAJ = "ordre";
            ajaxMajTaxo(rangMAJ, donnees);
        }

        donnees.append("ordre", selectOrdreTaxo.value);

        if ((rang + 1) == 2) {
            rangMAJ = "famille";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 2) {
            selectFamilleTaxo.options.length = 0;

            var option = document.createElement("option");
            option.text = "Nouvelle";
            option.value = "Nouveau";
            option.selected = true;
            selectFamilleTaxo.add(option);

            selectFamilleTaxo.setAttribute('name', '');
            familleTaxo.setAttribute('name', 'familleTaxo');
            familleTaxo.style.display = 'inline';
        }

        donnees.append("famille", selectFamilleTaxo.value);

        if ((rang + 1) == 3) {
            rangMAJ = "sousFamille";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 3) {
            selectSousFamilleTaxo.options.length = 0;

            var option = document.createElement("option");
            option.text = "Nouvelle";
            option.value = "Nouvelle";
            option.selected = true;
            selectSousFamilleTaxo.add(option);

            selectSousFamilleTaxo.setAttribute('name', '');
            sousFamilleTaxo.setAttribute('name', 'sousFamilleTaxo');
            sousFamilleTaxo.style.display = 'inline';
        }

        donnees.append("sousFamille", selectSousFamilleTaxo.value);

        if ((rang + 1) == 4) {
            rangMAJ = "genre";
            ajaxMajTaxo(rangMAJ, donnees);
        } else if ((rang + 1) < 4) {
            selectGenreTaxo.options.length = 0;

            var option = document.createElement("option");
            option.text = "Nouveau";
            option.value = "Nouveau";
            option.selected = true;
            selectGenreTaxo.add(option);

            selectGenreTaxo.setAttribute('name', '');
            genreTaxo.setAttribute('name', 'genreTaxo');
            genreTaxo.style.display = 'inline';
        }

    }

    function ajaxMajTaxo(rang, donnees) {
        var request = new XMLHttpRequest();

        rangSelect = "select" + rang[0].toUpperCase() + rang.substring(1) + "Taxo";
        rangInput = rang + "Taxo";

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText) {
                    input = document.getElementById(rangInput);
                    select = document.getElementById(rangSelect);
                    select.options.length = 0;

                    var option = document.createElement("option");

                    if (rang == "famille" || rang == "sousFamille") {
                        option.text = "Nouvelle";
                    } else {
                        option.text = "Nouveau";
                    }
                    option.value = "Nouveau";
                    option.selected = true;
                    select.add(option);

                    select.setAttribute('name', '');
                    input.setAttribute('name', rang + "Taxo");
                    input.style.display = 'inline';

                    liste = JSON.parse(this.responseText);

                    if (!(liste == null)) {
                        for (var i = 0; i < liste.length; i++) {
                            var option = document.createElement("option");
                            option.text = liste[i];
                            option.value = liste[i];
                            select.add(option);
                        }
                    }
                }
            }
        };

        donnees.append("rang", rang);

        request.open("POST", "./WebService/listeTaxonomieModifWS.php", true);
        request.send(donnees);
    }

    selectClasseTaxo.addEventListener("change", function() {
        majTaxo(0)
    });
    selectOrdreTaxo.addEventListener("change", function() {
        majTaxo(1)
    });
    selectFamilleTaxo.addEventListener("change", function() {
        majTaxo(2)
    });
    selectSousFamilleTaxo.addEventListener("change", function() {
        majTaxo(3)
    });
    selectGenreTaxo.addEventListener("change", function() {
        majTaxo(4)
    });

});
