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
    <div class="centered">
        <form class="przyciski">
            Od: <input name="from" type="date"> Do: <input name="to" type="date"> <input type="submit" class="btn btn-success" value="Wyświetl">
        </form>
        <?php
        if($_GET){
            require_once "config.php";
            $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
            if ($conn->connect_error) {
                die('błąd bazy: ' . $conn->connect_error . '"');
            }
            $conn->query("set names utf8;");
            $sql = "SELECT dni.date as data, typy.etykieta as etykieta FROM daneDni as dni LEFT JOIN typyDni as typy ON dni.typeDay = typy.id WHERE dni.user=".$_SESSION['id']." AND dni.date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."'";
            $result = $conn->query($sql);
            echo "<strong>".$result->num_rows ."</strong> wyników";
            if ($result->num_rows > 0) {

                echo "<table class='centered listaWpisow'>";
                echo "<tr><th>Data</th><th>Wpis</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['data']."</td>";
                    echo "<td>".$row['etykieta']."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else{

            }
            $conn->close();
        }
        ?>
    </div>
</body>
</html>