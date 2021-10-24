<?php
if (!$_GET) {
    header("Location: index.php");
    exit;
}
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowe hasło e-grafik</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <script src="./assets/jquery.js"></script>
    <script src="./assets/js/login.js"></script>
    <script src="./assets/js/main.js"></script>
</head>

<body onload="loadRegister()">
    <div class="position-absolute bottom-0 end-0" id="alert_placeholder"></div>
    <div class="loginBox">
        <div class="login-Box">
            <form action="" method="POST">
                <h1>Nowe Hasło</h1>
                <input name="password" id="password" class="textInput" type="password" placeholder=" Hasło">
                <br>
                <div class="passStrange" id="passPower"><span id="powerInf">Słabe</span></div>
                <input name="repassword" id="repassword" class="textInput" type="password" placeholder=" Powtórz hasło">
                <input type='submit' value="Zmień hasło" class='btn btn-success'>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if($_POST&&$_GET){
    if($_POST['password']==$_POST['repassword']){
        require "config.php";
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die('<script> showalert("Błąd bazy","' . $conn->connect_error . '","alert-danger") </script>');
        }
        $hash = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $sql = "UPDATE users LEFT JOIN passwordReset on users.id= passwordReset.kod SET password='".$hash."' WHERE passwordReset.kod = '".$_GET['kod']."' AND passwordReset.user=".$_GET['usr'];
        $conn->query($sql);
        $conn->query("DELETE FROM passwordReset WHERE kod='".$_GET['kod']."' AND user=".$_GET['usr']);
        $conn->close();
        echo '<script> showalert("Powodzenie","Zmieniono","alert-info") </script>';
    }
    else{
        echo '<script> showalert("Błąd","Hasła niezgodne","alert-danger") </script>';
    }
}
?>