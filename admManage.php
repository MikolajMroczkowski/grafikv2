<?php
session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    header("Location: login.php");
    exit;
}
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != true) {
    header("Location: index.php");
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
    <script src="./assets/js/admin.js"></script>
</head>

<body onload="readDivs()">
    <?php require "menu.php";
    renderMenu("adminManage") ?>
    <div class="position-absolute bottom-0 end-0" id="alert_placeholder"></div>
    <div class="centered">
        <h2 class="click"  onclick="toogleDiv('blokadyDiv','blokadyDivClick')">Blokady <img id="blokadyDivClick" src="./assets/icons/expand_more_black_24dp.svg"></h2>
        
        <div style="display: none;" id='blokadyDiv'>
        <input id="dataBlokady" type="date"><input class='adminBlokadaUstawienie' type="numeric" id="month" placeholder="miesiąc"><input class='adminBlokadaUstawienie' type="numeric" id="year" placeholder="rok"> 
        <button onclick="changeLock(document.getElementById('month').value,document.getElementById('year').value,document.getElementById('dataBlokady').value)" class="btn btn-success">Ustaw</button>
        <?php
        require_once "config.php";
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die('<script> showalert("Błąd bazy","' . $conn->connect_error . '","alert-danger" </script>');
        }
        $conn->query("set names utf8;");
        $sql = "SELECT * from blokada ORDER BY date DESC LIMIT 5";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<table class="centered adminListing">';
            echo '<tr>';
            echo '<th>miesiąc</th>';
            echo '<th>data</th>';
            echo '<th>Zapisz</th>';
            echo '<th>Usuń</th>';
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['month'].'.'.$row['year'].'</td>';
                echo '<td><input id="'.$row['id'].'" type="date" value="'.$row['date'].'"></td>';
                echo '<td><button onclick="removeLock('.$row['id'].'); addLock('.$row['month'].','.$row['year'].',document.getElementById(`'.$row['id'].'`).value)" class="btn btn-success">Zapisz</button></td>';
                echo '<td><button onclick="removeLock('.$row['id'].')" class="btn btn-danger">Usuń</button></td>';
                echo '</tr>';
            }
            echo '</table><br>';
        }
        echo "</div>";
        $sql = "SELECT * FROM grupyZawodowe";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<h2 class="click" onclick="toogleDiv(`grupyZawodowe`,`grupyZawodoweClick`)">Grupy Zawodowe <img id="grupyZawodoweClick" src="./assets/icons/expand_more_black_24dp.svg"></h2><div style="display: none;" id="grupyZawodowe"><input placeholder="nazwa" id="nazwaGrupy"> <button class="btn btn-success" onclick="createWorkGrup(document.getElementById(`nazwaGrupy`).value)">Utwóż</button><table class="centered adminListing">';
            echo '<tr>';
            echo '<th>id</th>';
            echo '<th>Grupa</th>';
            echo '<th>Usuń</th>';
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['Etykieta'].'</td>';
                echo '<td><button class="btn btn-danger" onclick="removeWorkGrup('.$row['id'].')">Usuń</buttton></td>';
                echo '</tr>';
            }
            echo '</table><br></div>';
        }
        $sql = "SELECT * FROM typyDni";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<h2 class="click" onclick="toogleDiv(`typyDni`,`typyDniClick`)">Typy dni <img id="typyDniClick" src="./assets/icons/expand_more_black_24dp.svg"></h2><div style="display: none;" id="typyDni"><input placeholder="nazwa" id="typeName"> <button class="btn btn-success" onclick="createType(document.getElementById(`typeName`).value)">Utwóż</button><table class="centered adminListing">';
            echo '<tr>';
            echo '<th>id</th>';
            echo '<th>Grupa</th>';
            echo '<th>Usuń</th>';
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['etykieta'].'</td>';
                echo '<td><button class="btn btn-danger" onclick="removeDayType('.$row['id'].')">Usuń</buttton></td>';
                echo '</tr>';
            }
            echo '</table><br></div>';
        }
        $sql = "SELECT * from typyDni";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<h2 class="click" onclick="toogleDiv(`uprawnieniaGrup`,`uprawnieniaGrupClick`)">Uprawnienia grup do dni <img id="uprawnieniaGrupClick" src="./assets/icons/expand_more_black_24dp.svg"></h2><div style="display: none;" id="uprawnieniaGrup">';
            echo '<select id="grupa">';
            $sql = "SELECT * from grupyZawodowe";
        $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">';
                echo $row['Etykieta'];
                echo '</option>';
            }
            echo '</select>';
            echo'do';
            echo '<select id="dzien">';
            $sql = "SELECT * from typyDni";
        $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">';
                echo $row['etykieta'];
                echo '</option>';
            }
            echo '</select>';
            echo '<button class="btn btn-success" onclick="createType(document.getElementById(`typeName`).value)">Utwóż</button><table class="centered adminListing">';
            echo '<tr>';
            echo '<th>Dzień (ID)</th>';
            echo '<th>Grupa (ID)</th>';
            echo '<th>Usuń</th>';
            echo '</tr>';
            $sql = "SELECT uprawnieniaDniDlaGrup.id AS uprawnienieId, grupyZawodowe.id AS grupaId, grupyZawodowe.Etykieta AS nazwaGrupy, typyDni.id AS typId, typyDni.etykieta AS nazwaTypu FROM uprawnieniaDniDlaGrup LEFT JOIN typyDni ON uprawnieniaDniDlaGrup.typDnia = typyDni.id LEFT JOIN grupyZawodowe ON uprawnieniaDniDlaGrup.grupa = grupyZawodowe.id ORDER BY uprawnieniaDniDlaGrup.id DESC";
        $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['nazwaTypu'].' ('.$row['typId'].')</td>';
                echo '<td>'.$row['nazwaGrupy'].' ('.$row['grupaId'].')</td>';
                echo '<td><button class="btn btn-danger" onclick="removeAuthorization('.$row['uprawnienieId'].')">Usuń</buttton></td>';
                echo '</tr>';
            }
            echo '</table><br></div>';
        }
        $sql = "SELECT max(logLogowan.timestamp) as time,users.name as imie,users.user as username FROM logLogowan LEFT JOIN users on logLogowan.user = users.id GROUP BY logLogowan.user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<h2 class="click" onclick="toogleDiv(`lastLogin`,`lastLoginClick`)">Ostatnie logowania <img id="lastLoginClick"  src="./assets/icons/expand_more_black_24dp.svg"></h2><div id="lastLogin" style="display: none;"><table class="centered adminListing">';
            echo '<tr>';
            echo '<th>Data</th>';
            echo '<th>Użytkownik</th>';
            echo '<th>Imię</th>';
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                $czas = new DateTime($row['time'],new DateTimeZone('UTC'));
                $czas -> setTimezone(new DateTimeZone('Europe/Warsaw'));
                echo '<tr>';
                echo '<td>'.$czas->format('d-m-Y H:i:s').'</td>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td>'.$row['imie'].'</td>';
                echo '</tr>';
            }
            echo '</table><br></div>';
        }
        $sql = "SELECT akceptaction.id as id,akceptaction.user as username,akceptaction.name as imie,akceptaction.mail as mail,grupyZawodowe.Etykieta as grupaZawodowa from akceptaction LEFT JOIN grupyZawodowe ON grupyZawodowe.id = akceptaction.grupaZawodowa";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<h2 class="click" onclick="toogleDiv(`doAkceptacji`,`doAkceptacjiClick`)">Użytkownicy do akceptacji <img id="doAkceptacjiClick" src="./assets/icons/expand_more_black_24dp.svg"></h2><div id="doAkceptacji" style="display: none;"><table class="centered adminListing">';
            echo '<tr>';
            echo '<th>Id</th>';
            echo '<th>Nazwa Użytkownika</th>';
            echo '<th>Imię</th>';
            echo '<th>e-mail</th>';
            echo '<th>Grupa Zawodowa</th>';
            echo '<th>Akcept</th>';
            echo '<th>Remove</th>';
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td>'.$row['imie'].'</td>';
                echo '<td>'.$row['mail'].'</td>';
                echo '<td>'.$row['grupaZawodowa'].'</td>';
                echo '<td><button onclick="aceptRequest('.$row['id'].')" class="btn btn-success">Akceptuj</button></td>';
                echo '<td><button onclick="deleteRequest('.$row['id'].')" class="btn btn-danger">Usuń</button></td>';
                echo '</tr>';
            }
            echo '</table><br>';
        }
        $sql = "SELECT users.id as id,users.user as username,users.name as imie,users.surname as nazwisko,users.mail as mail,grupyZawodowe.Etykieta as grupaZawodowa from users LEFT JOIN grupyZawodowe ON grupyZawodowe.id = users.grupaZawodowa";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<h2 class="click" onclick="toogleDiv(`users`,`usersClick`)">Aktualni użytkownicy <img id="usersClick" src="./assets/icons/expand_more_black_24dp.svg"></h2><div id="users" style="display: none;"><table class="centered adminListing">';
            echo '<tr>';
            echo '<th>Id</th>';
            echo '<th>Nazwa Użytkownika</th>';
            echo '<th>Imię</th>';
            echo '<th>Nazwisko</th>';
            echo '<th>e-mail</th>';
            echo '<th>Grupa Zawodowa</th>';
            echo '<th>Remove</th>';
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td>'.$row['imie'].'</td>';
                echo '<td>'.$row['nazwisko'].'</td>';
                echo '<td>'.$row['mail'].'</td>';
                echo '<td>'.$row['grupaZawodowa'].'</td>';
                echo '<td><button onclick="deleteUser('.$row['id'].')" class="btn btn-danger">Usuń</button></td>';
                echo '</tr>';
            }
            echo '</table><br></div>';
        }
        $conn->close();
        ?>
</body>

</html>