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
if ($_GET) {
    require_once "config.php";
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die('Błąd bazy:' . $conn->connect_error);
    }
    $sql = "SELECT * from akceptaction WHERE id=" . $_GET['id'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $conn->query("INSERT into users (user,name,password,mail,grupaZawodowa,isAdmin,surname) values ('" . $row['user'] . "','" . $row['name'] . "','" . $row['password'] . "','" . $row['mail'] . "'," . $row['grupaZawodowa'] . ",0,'".$_POST['surname']."')");
            $conn->query("DELETE from akceptaction WHERE id=" . $_GET['id']);
            echo 'Akceptowano';
        }
    } else {
    }
    $conn->close();
}
