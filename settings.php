<?php
session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel e-grafik</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <script src="./assets/jquery.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/settings.js"></script>
</head>

<body onload="init()">
<div class="position-absolute bottom-0 end-0" id="alert_placeholder"></div>
    <?php require "menu.php";
    renderMenu("settings") ?>
    <div class="centered">
        <h2>Zmiana Hasła</h2>
        <table class="centered settingTable">
            <tr>
                <td>Stare Hasło:</td>
                <td><input id="oldPass" type="password"></td>
            </tr>
            <tr>
                <td>Nowe Hasło:</td>
                <td><input id="newPass" type="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="passStrange" id="passPower"><span id="powerInf">Słabe</span></div></td>
            </tr>
            <tr>
                <td>Nowe Hasło jeszcze raz:</td>
                <td><input id="reNewPass" type="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><button onclick="changePass(document.getElementById('oldPass').value,document.getElementById('newPass').value,document.getElementById('reNewPass').value)" class="btn btn-info">Zmień</button></td>
            </tr>
        </table>
        <br>
        <h2>Zmiana E-maila</h2>
        <table class="centered settingTable">
            <tr>
                <td>Aktualny e-mail:</td>
                <td><?php echo $_SESSION['email']; ?></td>
            </tr>
            <tr>
                <td>Nowy email</td>
                <td><input id="mail" type="email"></td>
            </tr>
            <tr>
                <td></td>
                <td><button onclick="changeMail(document.getElementById('mail').value)" class="btn btn-info">Zmień</button></td>
            </tr>
        </table>
    </div>
</body>

</html>