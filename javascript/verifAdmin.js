document.addEventListener('DOMContentLoaded', function() {
    var divAdmin = document.getElementById('admin');

    if (role == 1){
        divAdmin.innerHTML = "<a href='/phppgadmin' target='_blank'>ACCES ADMIN</a>";
    } else {
        divAdmin.innerHTML = "";
    }
});
