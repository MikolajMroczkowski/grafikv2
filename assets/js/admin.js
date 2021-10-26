function removeFromArrById(arr, id) {
    var ilosc = arr.length;
    var newList = [];
    for (var i = 0; i < ilosc; i++) {
        if (i != id) {
            newList.push(arr[i]);
        }
    }
    return newList;
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
var nazwyDiv = [];
var wartosciDiv = [];
var nazwyImg = [];

function readDivs() {
    nazwyDiv = getCookie("divNames").split(",")
    wartosciDiv = getCookie("divValues").split(",")
    nazwyImg = getCookie("imgNames").split(",")
    for (var i = 0; 0 < nazwyDiv.length - 1; i++) {
        var div = document.getElementById(nazwyDiv[i]);
        var img = document.getElementById(nazwyImg[i]);
        div.style.display = wartosciDiv[i];
        if (div.style.display !== 'none') {
            img.src = "./assets/icons/expand_less_black_24dp.svg";
        } else {
            img.src = "./assets/icons/expand_more_black_24dp.svg";
        }
        console.log(i)
    }
}

function toogleDiv(divv, imgg) {
    var div = document.getElementById(divv);
    var img = document.getElementById(imgg);
    if (div.style.display !== 'none') {
        div.style.display = 'none';
        img.src = "./assets/icons/expand_more_black_24dp.svg";
    } else {
        div.style.display = 'block';
        img.src = "./assets/icons/expand_less_black_24dp.svg";
    }
    if (nazwyDiv.includes(divv)) {
        var indx = nazwyDiv.indexOf(divv);
        nazwyDiv = removeFromArrById(nazwyDiv, indx);
        wartosciDiv = removeFromArrById(wartosciDiv, indx);
        nazwyImg = removeFromArrById(nazwyImg, indx)
    }
    nazwyDiv.push(divv);
    nazwyImg.push(imgg);
    wartosciDiv.push(div.style.display);
    setCookie("divNames", nazwyDiv.toString(), 1)
    setCookie("divValues", wartosciDiv.toString(), 1)
    setCookie("imgNames", nazwyImg.toString(), 1)
}

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