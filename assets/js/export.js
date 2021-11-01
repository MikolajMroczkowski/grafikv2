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

}

function createExportForUser(user, row) {

}