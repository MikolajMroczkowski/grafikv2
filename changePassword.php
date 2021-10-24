<?php
session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    header("Location: login.php");
    exit;
}
if ($_POST) {
    if ($_POST['reNewPass'] == $_POST['newPass']) {
        $zgodnoscHasla = false;
        require_once "config.php";
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die('Proble bazy: ' . $conn->connect_error);
        }
        $sql = "SELECT password from users WHERE id=" . $_SESSION['id'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if(password_verify($_POST['oldPass'],$row['password'])){
                    $zgodnoscHasla = true;
                }
            }
        } else {
            echo 'Nieznany użytkownik';
        }
        if($zgodnoscHasla){
            $hash = password_hash($_POST['newPass'],PASSWORD_BCRYPT);
            $conn->query("UPDATE users SET password='".$hash."' WHERE id=".$_SESSION['id']);
            echo 'Zmieniono';
        }
        else{
            echo "Podaj poprawne stare hasło";
        }
        $conn->close();
    } else {
        echo "Hasła niezgodne!";
    }
}
