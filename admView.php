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
    <script src="./assets/js/export.js"></script>
</head>

<body onload="init()">
    <?php require "menu.php";
    renderMenu("adminView") ?>
    <div class="position-absolute bottom-0 end-0" id="alert_placeholder"></div>
    <div class="centered">
        <h2>Eksport</h2>
        <input value="" id="mc" placeholder="Miesiąc"><input value="" id="year" placeholder="Rok">
        <br>
        <button class='btn btn-success' onclick="window.open('admExport.php?mc='+document.getElementById('mc').value+'&year='+document.getElementById('year').value);">Exportuj</button>
        <br>
        <h2>Formatka</h2>
        <p><?php if (file_exists("export/formatka.xlsx")) {
                echo 'Załadowano <a href="export/formatka.xlsx">format</a>';
            } else {
                echo 'BRAK FORMATU';
            } ?></p>
        <form method="POST" enctype="multipart/form-data">
            <input name='plik' type='file'><input type='submit' class='btn btn-info' value="Upload">
        </form>
        <?php
        if (isset($_FILES['plik'])) {
            $errors = array();
            $file_name = $_FILES['plik']['name'];
            $file_size = $_FILES['plik']['size'];
            $file_tmp = $_FILES['plik']['tmp_name'];
            $file_type = $_FILES['plik']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['plik']['name'])));
            $expensions = array("xlsx");
            if (!in_array($file_ext, $expensions)) {
                $errors[] = 'Rozszeżenie niezgodne z xlsx';
            }
            if ($file_size > 2097152) {
                $errors[] = 'Plik za duży 2 MB';
            }
            if (empty($errors) == true) {
                unlink("export/formatka.xlsx");
                move_uploaded_file($file_tmp, "export/formatka.xlsx");
                echo "Dodano format pomyślnie";
            } else {
                print_r($errors[0]);
            }
        }
        ?>
        <br>
        <h2>Użytkownicy Do Eksportu</h2>
        <?php
        require_once "config.php";
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die('<script> showalert("Błąd bazy","' . $conn->connect_error . '","alert-danger" </script>');
        }
        $conn->query("set names utf8;");
        echo '<select id="user">';
        $sql = "SELECT id,user,name,surname from users";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">';
            echo $row['user'] . " (" . $row['name'] . " " . $row['surname'] . ")";
            echo '</option>';
        }
        echo '</select>';
        $conn->close();
        ?>
        <input id="row" placeholder="Wiersz" style="width:75px"> <button onclick="createExportForUser(document.getElementById(`user`).options[document.getElementById(`user`).selectedIndex].value,document.getElementById(`row`).value)" class='btn btn-success'>Dodaj</button>
        <?php
        require_once "config.php";
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die('<script> showalert("Błąd bazy","' . $conn->connect_error . '","alert-danger" </script>');
        }
        $conn->query("set names utf8;");
        $sql = "SELECT users.user as username, users.name as imie, users.surname as nazwisko, usersTableRow.wiersz as wiersz, usersTableRow.id as id from usersTableRow LEFT JOIN users ON users.id = usersTableRow.user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<table class="centered adminListing">';
            echo '<tr>';
            echo '<th>Użytkownik</th>';
            echo '<th>Wiersz</th>';
            echo '<th>Usuń</th>';
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                $czas = new DateTime($row['time'], new DateTimeZone('UTC'));
                $czas->setTimezone(new DateTimeZone('Europe/Warsaw'));
                echo '<tr>';
                echo '<td>' . $row['username'] . " (" . $row['imie'] . " " . $row['nazwisko'] . ")" . '</td>';
                echo '<td>' . $row['wiersz'] . '</td>';
                echo '<td><button onclick="removeExportForUser(' . $row['id'] . ')" class="btn btn-danger">Usuń</button></td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        $conn->close();
        ?>
    </div>
</body>

</html>