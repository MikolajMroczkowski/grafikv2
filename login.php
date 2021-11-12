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
    <title>Zaloguj się e-grafik</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <script src="./assets/jquery.js"></script>
    <script src="./assets/js/login.js"></script>
</head>

<body onload='initLogin()'>
    <div id="myNav" class="overlay">
        <div class="overlay-content">
            Przechodządz dalej akceptujesz <a href="regulamin.php">Regulamin</a>, <a href="politykaPrywatnosci.php">Politykę prywatności</a> i <a href="rodo.php">RODO</a><br>
            Akceptujesz także używanie przez nas plików cookie w stopniu wymaganym do funkcjonowania aplikacji
            <br>
            <button onclick='document.getElementById("myNav").style.width = "0%"; setCookie(`ciasteczka`,`true`,31)' class="btn btn-info">Akceptuję</button>
        </div>

    </div>
    <div id="mobLock" class="overlay">
        <div class="overlay-content">
            Niestety Twoje użądzenie mobilne jest nieobsługiwane<br><a href="aplikacja.apk">Pobierz Aplikacje Mobilną</a>
            <br>
        </div>

    </div>
    <div class="loginBox">
        <div class="login-Box">
            <form action="" method="POST">
                <h1>Zaloguj się</h1>
                <input id="login" name="login" class="textInput" placeholder=" Login">
                <br>
                <input id="password" name="password" class="textInput" type="password" placeholder=" Hasło">
                <span id='passErr'><br></span>
                <input type='submit' value="Zaloguj się" class='btn btn-success'>
                <br>
                <a href="./forgotPassword.php">Zapomniane Hasło</a>
                <br>
                <a href="./register.php">Zarejstruj się</a>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if ($_POST) {
    if (isset($_POST['login']) && isset($_POST['password']) && $_POST['login'] != '' && $_POST['password'] != '') {
        $email = strpos($_POST['login'], "@");
        require_once "config.php";
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die('<script> document.getElementById("login").classList.add("error");
            document.getElementById("password").classList.add("error");
            document.getElementById("passErr").innerHTML = "Database Error: ' . $conn->connect_error . '" </script>');
        }
        if ($email) {
            $sql = "SELECT * from users WHERE mail='" . $_POST['login'] . "'";
        } else {
            $sql = "SELECT * from users WHERE user='" . $_POST['login'] . "'";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $conn->query("INSERT INTO logLogowan (user,timestamp) values (" . $row['id'] . ",now())");
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['user'];
                $_SESSION['email'] = $row['mail'];
                $_SESSION['grupaZawodowa'] = $row['grupaZawodowa'];
                $_SESSION['isAdmin'] = $row['isAdmin'] == 1;
                $_SESSION['logged'] = true;
                $_SESSION['workGroup'] = $row['grupaZawodowa'];
                $_SESSION['imie'] = $row['name'];
                header("Location: index.php");
                exit;
            }
        } else {
            if ($email) {
                $sql = "SELECT * from akceptaction WHERE mail='" . $_POST['login'] . "'";
            } else {
                $sql = "SELECT * from akceptaction WHERE user='" . $_POST['login'] . "'";
            }
            $result2 = $conn->query($sql);
            if ($result2->num_rows > 0) {
                echo '
                <script>
                document.getElementById("login").classList.add("error");
                document.getElementById("passErr").innerHTML = "Użytkownik niezostał akceptowany przez administartora<br>";
                </script>
                ';
            } else {
                echo '
                <script>
                document.getElementById("login").classList.add("error");
                document.getElementById("passErr").innerHTML = "Użytkownik nieznany<br>";
                </script>
                ';
            }
        }
        $conn->close();
    } else {
        echo '
        <script>
        document.getElementById("login").classList.add("error");
        document.getElementById("password").classList.add("error");
        document.getElementById("passErr").innerHTML = "Wprowadź pełne dane<br>";
        </script>
        ';
    }
}
?>