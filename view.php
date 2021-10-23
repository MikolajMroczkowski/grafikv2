<?php
session_start();
if(!isset($_SESSION['logged'])|| $_SESSION['logged']!=true){
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
</head>
<body>
    <?php require "menu.php"; renderMenu("view") ?>
</body>
</html>