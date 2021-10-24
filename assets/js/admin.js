function aceptUser(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showalert('', this.responseText, 'alert-info');
        }
    };
    xmlhttp.open("GET", "admAceptUser.php?id=" + id, true);
    xmlhttp.send();
}

function deleteUser(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showalert('', this.responseText, 'alert-info');
        }
    };
    xmlhttp.open("GET", "admAceptUser.php?id=" + id, true);
    xmlhttp.send();
}