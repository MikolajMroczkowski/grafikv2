<?php
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
    <title>Zapomnine hasło e-grafik</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <script src="./assets/jquery.js"></script>
    <script src="./assets/js/login.js"></script>
    <script src="./assets/js/main.js"></script>
</head>

<body>
<div class="position-absolute bottom-0 end-0" id="alert_placeholder"></div>
    <div class="loginBox">
        <div class="login-Box">
            <form action="" method="POST">
                <h1>Reset Hasła</h1>
                <input id="login" name="email" class="textInput" placeholder=" E-mail">
                <br>
                <input type='submit' value="Zresetuj hasło" class='btn btn-success'>
                <br>
                <a href="./login.php"><- Zaloguj się</a>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if ($_POST) {
    require_once 'vendor/autoload.php';
    if(strpos($_POST['email'], "@")){
        require_once "config.php";
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die('<script> showalert("Błąd bazy","' . $conn->connect_error . '","alert-danger") </script>');
        }
        $sql = "SELECT id,name from users WHERE mail='" . $_POST['email'] . "'";
        $conn->query("set names utf8;");
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kod = GenerujKod();
                $conn->query("INSERT into passwordReset (kod,user) values ('" . $kod . "'," . $row['id'] . ")");
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP();
                $mail->Mailer = "smtp";
                $mail->SMTPDebug  = 0;
                $mail->SMTPAuth   = TRUE;
                $mail->SMTPSecure = "tls";
                $mail->Port       = $smtpport;
                $mail->Host       = $smtpserver;
                $mail->Username   = $smtpuser;
                $mail->Password   = $smtppass;
                $mail->IsHTML(true);
                $mail->AddAddress($_POST['email'], "Użytkownik któr");
                $mail->SetFrom("e-grafik@e-buda.eu", "e-grafik by e-buda");
                $mail->AddReplyTo("admin@e-buda.eu", "administracja");
                $mail->Subject = "Reset haslo do konta";
                $content = "<h1>Witaj <strong>".$row['name']."</strong></h1><b>Zresetuj haslo tutaj: </b><a href='https://e-buda.eu/grafik/resetprocessor.php?usr=" . $row['id'] . "&kod=" . $kod . "'>Resetuj</a>";
                $mail->MsgHTML($content);
                if (!$mail->Send()) {
                    echo '<script>showalert("Niepowodzenie","Nie udało się wysłać e-maila potwierdzajadzego","alert-danger")</script>';
                } else {
                    echo '<script>showalert("Powodzenie","Wiadomość resetu wysłana","alert-success")</script>';
                    header("refresh:5;url=login.php");
                }
            }
        }
        else{
            echo '<script> showalert("Błąd","Niemożna znaleźć użytkownika","alert-danger") </script>';
        }
        $conn->close();
    }
}
function GenerujKod($length = 75) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>