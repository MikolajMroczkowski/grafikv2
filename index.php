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
    <link rel="stylesheet" href="./assets/css/overlay.css">
    <script src="./assets/jquery.js"></script>
    <script src="./assets/js/main.js"></script>
</head>

<body>
    <div class="position-absolute bottom-0 end-0" id="alert_placeholder"></div>
    <?php require "menu.php";
    require "getUserCal.php";
    renderMenu("edit");
    if ($_GET) {
        $mounth = $_GET['mounth'];
        $year = $_GET['year'];
    } else {
        $mounth = date('m');
        $year = date('Y');
    }
    if ($mounth == 12) {
        $yearNext = $year + 1;
        $mounthNext = 1;
        $yearPrevius = $year;
        $mounthPrevius = $mounth - 1;
    } elseif ($mounth == 1) {
        $yearNext = $year;
        $mounthNext = $mounth + 1;
        $yearPrevius = $year - 1;
        $mounthPrevius = 12;
    } else {
        $yearNext = $year;
        $mounthNext = $mounth + 1;
        $yearPrevius = $year;
        $mounthPrevius = $mounth - 1;
    }
    echo '<div class="centered"><div class="przyciski">';
    echo '<a class="btn btn-dark" href="index.php?mounth=' . $mounthPrevius . '&year=' . $yearPrevius . '"><- Previous</a> ';
    echo '<a class="btn btn-dark" href="index.php?mounth=' . $mounthNext . '&year=' . $yearNext . '">Next -></a>';
    echo '</div>';
    require_once "config.php";
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die('Błąd odczytu danych');
    }
    $edit = true;
    $conn->query("set names utf8;");
    $sql = "SELECT date as dataBlokady FROM blokada WHERE month=" . $mounth . " AND year=" . $year;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dzienBlokady = strtotime($row['dataBlokady']);
            date_default_timezone_set('Europe/Warsaw');
            $date = strtotime(date('Y-m-d'));
            $edit = !($dzienBlokady < $date);
        }
    } else {
        $monthA = $mounth;
        $yearA = $year;
        $dayBlokady = 20;
        $ostatni = strtotime($dayBlokady . "-" . $monthA . "-" . $yearA);
        $dzienSlowo =  date('l', $ostatni);
        switch (substr($dzienSlowo, 0, 3)) {
            case "Mon":
                $blank = 3;
                break;
            case "Tue":
                $blank = 4;
                break;
            case "Wed":
                $blank = 5;
                break;
            case "Thu":
                $blank = 6;
                break;
            case "Fri":
                $blank = 0;
                break;
            case "Sat":
                $blank = 1;
                break;
            case "Sun":
                $blank = 2;
                break;
        }
        $dayBlokady -= $blank;
        $dzienBlokady = strtotime($dayBlokady . "-" . $monthA . "-" . $yearA);
        date_default_timezone_set('Europe/Warsaw');
        $date = strtotime(date('Y-m-d'));
        $edit = !($dzienBlokady < $date);
    }
    $conn->close();
    $c = new Calendar($year, $mounth, $edit);
    echo '</div>';

    ?>
    <div id="choseDayTypeOverlay" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeOverlay()">&times;</a>
        <div class="overlay-content">
            <h2>Edytujesz dzień <span id="nowEditing"></span></h2>
            <span class='choice' onclick='saveDay("REMOVE");'>Wyczyść Dzień</span><br>
            <?php
            require_once "config.php";
            $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
            if ($conn->connect_error) {
                die('Błąd odczytu danych');
            }
            $conn->query("set names utf8;");
            $sql = "SELECT s1.etykieta as etykieta,s1.id as id from typyDni as s1 LEFT JOIN uprawnieniaDniDlaGrup as s2 on s1.id = s2.typDnia WHERE s2.grupa = " . $_SESSION['grupaZawodowa'];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<span class='choice' onclick='saveDay(" . $row['id'] . ");'>" . $row['etykieta'] . "</span><br>";
                }
            } else {
                echo 'baza typów jest pusta<br>Skontaktoj się z administratorem systemu';
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>