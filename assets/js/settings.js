function checkPassStrenge(pass) {
    var moc = 0;
    var znaki = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    var liczby = /123456789/;
    if (pass.length > 8) {
        moc += 1;
    }
    if (pass.length > 10) {
        moc += 1;
    }
    if (pass.toUpperCase() != pass && pass.toLowerCase() != pass) {
        moc += 1;
    }
    if (znaki.test(pass)) {
        moc += 1;
    }
    if (/\d/.test(pass)) {
        moc += 1
    }
    return moc;

}

function init() {
    var mocZnika = setTimeout(function() { power.style.display = "none"; }, 1);
    var pass = document.getElementById("newPass")
    var power = document.getElementById("passPower");
    var powerInf = document.getElementById("powerInf")
    power.style.display = "none";
    const inputHandler = function(e) {
        clearTimeout(mocZnika);
        var passwordPower = checkPassStrenge(e.target.value);
        console.log(passwordPower);
        if (passwordPower > 2 & passwordPower < 4) {
            power.style.display = "block";
            power.style.backgroundColor = "#fc0"
            powerInf.innerHTML = "Hasło średnie"
        } else if (passwordPower >= 4) {
            power.style.display = "block";
            power.style.backgroundColor = "#0f0"
            powerInf.innerHTML = "Hasło mocne"
        } else {
            power.style.display = "block";
            power.style.backgroundColor = "#f00"
            powerInf.innerHTML = "Hasło słabe"
        }
        mocZnika = setTimeout(function() { power.style.display = "none"; }, 3500)

    }
    pass.addEventListener('input', inputHandler);
    pass.addEventListener('propertychange', inputHandler);
}

function changePass(oldPass, newPass, reNewPass) {
    var http = new XMLHttpRequest();
    var url = 'changePassword.php';
    var params = 'oldPass=' + oldPass + '&newPass=' + newPass + '&reNewPass=' + reNewPass;
    http.open('POST', url, true);

    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() { //Call a function when the state changes.
        if (http.readyState == 4 && http.status == 200) {
            showalert('', this.responseText, 'alert-info');
        }
    }
    http.send(params);
}

function changeMail(mail) {
    var http = new XMLHttpRequest();
    var url = 'changeMail.php';
    var params = 'mail=' + mail;
    http.open('POST', url, true);

    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() { //Call a function when the state changes.
        if (http.readyState == 4 && http.status == 200) {
            showalert('', this.responseText, 'alert-info');
            setTimeout(function() {
                location = location
            }, 500)
        }
    }
    http.send(params);
}

function createNewToken() {
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
    xmlhttp.open("GET", "newToken.php", true);
    xmlhttp.send();
}

function removeToken(id) {
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
    xmlhttp.open("GET", "removeToken.php?id=" + id, true);
    xmlhttp.send();
}