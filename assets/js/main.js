var day = 1;
var mounth = 1;
var year = 1970;

function saveDay(type) {
    closeOverlay();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showalert('', this.responseText, 'alert-info')
        }
    };
    xmlhttp.open("GET", "saveDay.php?mounth=" + mounth + "&year=" + year + "&day=" + day + "&typDnia=" + type, true);
    xmlhttp.send();
    setTimeout(function() {
        location = location;
    }, 500)
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

function showalert(tittle, message, alerttype) {
    $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><span><strong>' + tittle + '</strong> ' + message + '</span></div>')
    setTimeout(function() {
        $("#alertdiv").remove();
    }, 4000);
}