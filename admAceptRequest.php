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
            require_once 'vendor/autoload.php';
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
            $mail->CharSet = "UTF-8";
            $mail->IsHTML(true);
            $mail->AddAddress($row['mail'], $row['name']);
            $mail->SetFrom($sendFormMail, "e-grafik by e-buda");
            $mail->AddReplyTo($replayToMail, $replayToName);
            $mail->Subject = "Administrator dodał towje konto";
            $content = "<h1>Witaj <strong>" . $row['name'] . "</strong></h1><br>Piszemy żeby cię poinformować, że twoja prośba o założenie konta została zaakceptowana.<br>Dziękujemy, że jesteś z nami<br>Miłego korzystanoia i Miłego dnia<br><b>e-buda Systems</b>";
            $mail->MsgHTML($content);
            if (!$mail->Send()) {
                echo 'błąd wysyłanie emial';
            }
            $conn->query("INSERT into users (user,name,password,mail,grupaZawodowa,isAdmin,surname) values ('" . $row['user'] . "','" . $row['name'] . "','" . $row['password'] . "','" . $row['mail'] . "'," . $row['grupaZawodowa'] . ",0,'" . $row['surname'] . "')");
            $conn->query("DELETE from akceptaction WHERE id=" . $_GET['id']);
            echo 'Akceptowano';
        }
    } else {
    }
    $conn->close();
}
