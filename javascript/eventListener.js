document.addEventListener('DOMContentLoaded', function() {

    var form = document.getElementsByTagName('form');

    for (var i = 0; i < form.length; i++) {
        form[i].addEventListener("keypress", function(event) {

            if(event.keyCode == 13) {
                var inputs = this.elements;

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i] == document.activeElement) {
                        e = i + 1;
                    }
                }
                inputs[e].focus();
                event.preventDefault();
            }


        })
    }

});
