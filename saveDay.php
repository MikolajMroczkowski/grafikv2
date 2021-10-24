<?php
if ($_GET) {
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
        header("Location: login.php");
        exit;
    }
    if (isset($_GET['day']) && $_GET['day'] != '' && isset($_GET['year']) && $_GET['year'] != '' && isset($_GET['mounth']) && $_GET['mounth'] != '' && isset($_GET['typDnia']) && $_GET['typDnia'] != '') {
        require_once "config.php";
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die('Błąd odczytu danych');
        }
        $blokada = false;
        $conn->query("set names utf8;");
        $sql = "SELECT date as dataBlokady FROM blokada WHERE month=" . $mounth . " AND year=" . $year;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dzienBlokady = strtotime($row['dataBlokady']);
                date_default_timezone_set('Europe/Warsaw');
                $date = strtotime(date('Y-m-d'));
                $blokada = $dzienBlokady < $date;
            }
        }
        if (!$blokada) {
            if ($_GET['typDnia'] == 'REMOVE') {
                $conn->query("DELETE FROM daneDni WHERE date = '" . $_GET['year'] . "-" . $_GET['mounth'] . "-" . $_GET['day'] . "'");
                echo "Usunięto <strong>" . $_GET['day'] . "." . $_GET['mounth'] . "." . $_GET['year'] . "</strong>";
            } else {
                $result3 = $conn->query("SELECT * from daneDni where user=".$_SESSION['id']." date='".$_GET['year']."-".$_GET['mounth']."-".$_GET['day']."'");
                if ($result3->num_rows > 0) {
                    $result2 = $conn->query("SELECT s1.etykieta as etykieta ,s1.class as class,s1.id as id from typyDni as s1 LEFT JOIN uprawnieniaDniDlaGrup as s2 on s1.id = s2.typDnia WHERE s2.grupa=" . $_SESSION['workGroup'] . " AND s1.id =" . $_GET['typDnia']);
                    if ($result2->num_rows > 0) {
                        $conn->query("INSERT INTO daneDni (typeDay,user,date) VALUES (" . $_GET['typDnia'] . "," . $_SESSION['id'] . ",'" . $_GET['year'] . "-" . $_GET['mounth'] . "-" . $_GET['day'] . "')");
                        echo "Dodano <strong>" . $_GET['day'] . "." . $_GET['mounth'] . "." . $_GET['year'] . "</strong>";
                    } else {
                        echo "Dzień <strong>" . $_GET['day'] . "." . $_GET['mounth'] . "." . $_GET['year'] . "</strong> jest pełen";
                    }
                } else {
                    echo 'Typ niedostępna/nieistnieje';
                }
            }
        } else {
            echo 'ecycja niemożliwa!';
        }
        $conn->close();
    } else {
        echo 'dane zapisu niepełne lub puste';
    }
}
