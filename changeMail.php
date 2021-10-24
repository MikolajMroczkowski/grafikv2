<?php
session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    header("Location: login.php");
    exit;
}
if ($_POST) {
    require_once "config.php";
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die('Proble bazy: ' . $conn->connect_error);
    }
    $conn->query("UPDATE users SET mail='" . $_POST['mail'] . "' WHERE id=" . $_SESSION['id']);
    $_SESSION['email'] = $_POST['mail'];
    echo 'Zmieniono';
    $conn->close();
}
