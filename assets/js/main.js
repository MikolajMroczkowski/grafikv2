var day = 1;
var mounth = 1;
var year = 1970;

function saveDay() {
    closeOverlay();

}

function showOverlay(pday, pmounth, pyear) {
    day = pday;
    mounth = pmounth;
    year = pyear;
    rday = day;
    rmounth = mounth;
    if (day.toString().length != 2) {
        rday = "0" + day;

    }
    if (mounth.toString().length != 2) {
        rmounth = "0" + mounth;

    }
    document.getElementById("nowEditing").innerHTML = rday + "." + rmounth + "." + year
    document.getElementById("choseDayTypeOverlay").style.display = "block";
}

function closeOverlay() {
    document.getElementById("choseDayTypeOverlay").style.display = "none";
}