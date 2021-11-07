<?php
function generateRandomString($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    header("Location: login.php");
    exit;
}
require_once "config.php";
$conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die('Błąd bazy:' . $conn->connect_error);
}
$token = generateRandomString();
$conn->query("INSERT into tokens (token,grupaZawodowa,user) values ('" . $token . "'," . $_SESSION['grupaZawodowa'] . "," . $_SESSION['id'] . ")");
$conn->close();
echo "Stworzono";
