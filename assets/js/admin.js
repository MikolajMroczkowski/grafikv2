function aceptRequest(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showalert('', this.responseText, 'alert-info');
            setTimeout(
                function() {
                    location = location
                }, 1000
            );
        }
    };
    xmlhttp.open("GET", "admAceptRequest.php?id=" + id, true);
    xmlhttp.send();
}

function deleteRequest(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showalert('', this.responseText, 'alert-info');
            setTimeout(
                function() {
                    location = location
                }, 1000
            );
        }
    };
    xmlhttp.open("GET", "admRemoveRequest.php?id=" + id, true);
    xmlhttp.send();
}

function deleteUser(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showalert('', this.responseText, 'alert-info');
            setTimeout(
                function() {
                    location = location
                }, 1000
            );
        }
    };
    xmlhttp.open("GET", "admRemoveUser.php?id=" + id, true);
    xmlhttp.send();
}

function addLock(month, year, data) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showalert('', this.responseText, 'alert-info');
            setTimeout(
                function() {
                    location = location
                }, 4000
            );
        }
    };
    xmlhttp.open("GET", "admAddeLock.php?month=" + month + "&year=" + year + "&date=" + data, true);
    xmlhttp.send();
}

function removeLock(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showalert('', this.responseText, 'alert-info');
            setTimeout(
                function() {
                    location = location
                }, 1000
            );
        }
    };
    xmlhttp.open("GET", "admRemoveLock.php?id=" + id, true);
    xmlhttp.send();
}