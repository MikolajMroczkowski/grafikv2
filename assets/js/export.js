const d = new Date();
var month = d.getMonth() + 1;
var year = d.getFullYear();
month++;
if (month == 13) {
    year++;
    month = 1;
}

function init() {
    document.getElementById('mc').value = month;
    document.getElementById('year').value = year;
}

function removeExportForUser(id) {
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
    xmlhttp.open("GET", "admRemoveExportForUser.php?id=" + id, true);
    xmlhttp.send();
}

function createExportForUser(user, row) {
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
    xmlhttp.open("GET", "admCreateExportForUser.php?user=" + user + "&row=" + row, true);
    xmlhttp.send();
}