<?php
ini_set("display_errors", 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    header("Location: login.php");
    exit;
}
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != true) {
    header("Location: index.php");
    exit;
}
if ($_GET) {
    $dir = 'export';
    $leave_files = array('formatka.xlsx');
    foreach (glob("$dir/*") as $file) {
        if (!in_array(basename($file), $leave_files)) {
            unlink($file);
        }
    }
    require_once 'vendor/autoload.php';
    require_once 'config.php';
    $mc = $_GET['mc'];
    $year = $_GET['year'];
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    try {
        $spreadsheet = $reader->load("export/formatka.xlsx");
    } catch (Exception $e) {
        echo "Kontynuowanie bez formatu...<br>";
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    }
    $mcPL = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
    $litery = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH","AI","AJ","AK");
    for ($x = 1; $x < 31; $x++) {
        $dataKomurki = strtotime($x . "." . $mc . "." . $year);
        $day_of_week = date('D', $dataKomurki);
        switch ($day_of_week) {
            case "Mon":
                $blank = 0;
                break;
            case "Tue":
                $blank = 1;
                break;
            case "Wed":
                $blank = 2;
                break;
            case "Thu":
                $blank = 3;
                break;
            case "Fri":
                $blank = 4;
                break;
            case "Sat":
                $blank = 5;
                break;
            case "Sun":
                $blank = 6;
                break;
        }
        if ($blank == 4 || $blank == 5) {
            $spreadsheet->getActiveSheet()->getStyle($litery[$x + 1] . '1:' . $litery[$x + 1] . '40')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB("ebebeb");
        }
    }
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die('błąd');
    }
    $conn->query("set names utf8;");
    $sql = "SELECT typyDni.kod as wartosc, DAY(daneDni.date) as kolumna,  usersTableRow.wiersz as wiersz FROM daneDni INNER JOIN usersTableRow ON daneDni.user = usersTableRow.user INNER JOIN typyDni ON daneDni.typeDay=typyDni.id WHERE daneDni.date BETWEEN '" . $year . "-" . $mc . "-1' AND '" . $year . "-" . $mc . "-31'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cell = $litery[$row['kolumna']] . $row['wiersz'];
            $spreadsheet->getActiveSheet()->setCellValue($cell, $row['wartosc']);
            $spreadsheet->getActiveSheet()->getStyle($cell)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB("ff9980");
        }
    } else {
    }
    $sql = "SELECT users.name AS imie, users.surname AS nazwisko, users.user AS username, usersTableRow.wiersz AS wiersz from usersTableRow LEFT JOIN users ON users.id = usersTableRow.user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cell = $litery[36] . $row['wiersz'];
            $spreadsheet->getActiveSheet()->setCellValue($cell, $row['username']." (".$row['imie']." ".$row['nazwisko'].")");
        } 
    } else {
    }
    $conn->close();
    $spreadsheet->getActiveSheet()->setCellValue('A1', $mcPL[$mc - 1]);
    $spreadsheet->getProperties()->setCreator("System e-grafik");
    $spreadsheet->getProperties()->setLastModifiedBy("System e-grafik");
    $spreadsheet->getProperties()->setTitle("Grafik Programu e-grafik");
    $spreadsheet->getProperties()->setSubject("Grafik Programu e-grafik");
    $spreadsheet->getProperties()->setDescription("Grafki przygotowany przez e-grafik by e-buda systems");
    $spreadsheet->getActiveSheet()->setTitle($mcPL[$mc - 1] . "_" . $year);
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save('export/e-grafik_' . $mc . '_' . $year . '.xlsx');
    echo '<script> window.open("export/e-grafik_' . $mc . '_' . $year . '.xlsx"); </script>Jeśli pobieranie się nie rozpoczeło <a href="export/e-grafik_' . $mc . '_' . $year . '.xlsx">Kliknij tutaj</a> ';
}
