<?php
session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    header("Location: login.php");
    exit;
}
if ($_GET) {
    require_once "config.php";
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die('Błąd bazy:' . $conn->connect_error);
    }
    $conn->query("DELETE FROM tokens WHERE id=".$_GET['id']." AND ".$_SESSION['id']);
    echo 'Usunięto';
    $conn->close();
}
