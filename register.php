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
    <title>Zarejstruj się e-grafik</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <script src="./assets/jquery.js"></script>
    <script src="./assets/js/login.js"></script>
</head>

<body onload="loadRegister()">
    <div class="loginBox">
        <div class="login-Box">
            <form method="POST">
                <h1>Zarejstruj się</h1>
                <input name="login" id="login" class="textInput" placeholder=" Login">
                <br>
                <input name="name" id="name" class="textInput" placeholder=" Imię">
                <br>
                <input name="surname" id="surname" class="textInput" placeholder=" Nazwisko">
                <br>
                <input name="mail" id="mail" class="textInput" placeholder=" E-mail">
                <br>
                <select name="grupaZawodowa" id="grupaZawodowa" class="textInput">
                    <?php
                    require_once "config.php";
                    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
                    if ($conn->connect_error) {
                        die('<option value="err">BŁĄD ODCZYTU DANYCH ODŚWIERZ STRONĘ</option>');
                    }
                    $sql = "SELECT * from grupyZawodowe";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo '<option value="NONE">---Wybierz grupę zawodową---</option>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . $row['Etykieta'] . '</option>';
                        }
                    } else {
                        echo '<option value="err">BRAK GRUP ZAWODOWYCH!</option>';
                    }
                    ?>
                </select>
                <br>
                <input name="password" id="password" class="textInput" type="password" placeholder=" Hasło">
                <br>
                <div class="passStrange" id="passPower"><span id="powerInf">Słabe</span></div>
                <input name="repassword" id="repassword" class="textInput" type="password" placeholder=" Powtórz hasło">
                <span id="passErr"><br></span>
                <input type='submit' value="Zarejstruj się" class='btn btn-success'>
                <br>
                <a href="./login.php">Masz już konto? Zaloguj się</a>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if ($_POST) {
    if (isset($_POST['name']) && $_POST['name'] != "" && isset($_POST['grupaZawodowa']) && $_POST['grupaZawodowa'] != "" && isset($_POST['login']) && isset($_POST['mail']) && $_POST['mail'] != '' && isset($_POST['password']) && $_POST['login'] != '' && $_POST['password'] != '' && isset($_POST['repassword']) && $_POST['repassword'] != '') {
        if ($_POST['grupaZawodowa'] == "err") {
            echo '<script>
            document.getElementById("grupaZawodowa").classList.add("error");
                        document.getElementById("login").classList.add("error");
                        document.getElementById("name").classList.add("error");
                        document.getElementById("surname").classList.add("error");
                        document.getElementById("mail").classList.add("error");
                        document.getElementById("password").classList.add("error");
                        document.getElementById("repassword").classList.add("error");
            document.getElementById("passErr").innerHTML = "Wystąpił błąd przetwarzania backend <br>" </script>';
        } else if ($_POST['grupaZawodowa'] == "NONE") {
            echo '<script>
            document.getElementById("grupaZawodowa").classList.add("error");
            document.getElementById("passErr").innerHTML = "Wybierz grupę zawodową <br>" </script>';
        } else {
            if ($_POST['password'] != $_POST['repassword']) {
                echo '
        <script>
        document.getElementById("password").classList.add("error");
        document.getElementById("repassword").classList.add("error");
        document.getElementById("passErr").innerHTML = "Hasła niezgodne<br>";
        </script>
        ';
            } else {
                require_once "config.php";
                $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
                if ($conn->connect_error) {
                    die('<script> document.getElementById("grupaZawodowa").classList.add("error");
                    document.getElementById("login").classList.add("error");
                    document.getElementById("name").classList.add("error");
                    document.getElementById("surname").classList.add("error");
                    document.getElementById("mail").classList.add("error");
                    document.getElementById("password").classList.add("error");
                    document.getElementById("repassword").classList.add("error");
            document.getElementById("passErr").innerHTML = "Database Error: ' . $conn->connect_error . '" </script>');
                }
                $sql = "SELECT * FROM akceptaction WHERE user = '" . $_POST['login'] . "' OR mail='" . $_POST['mail'] . "' UNION SELECT * FROM users WHERE user = '" . $_POST['login'] . "' OR mail='" . $_POST['mail'] . "'";
                $result = $conn->query($sql);
                if ($result->num_rows == 0) {
                    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    if ($conn->query("INSERT INTO akceptaction (user,mail,password,grupaZawodowa,name,surname,isAdmin) VALUES ('" . $_POST['login'] . "','" . $_POST['mail'] . "','" . $hash . "'," . $_POST['grupaZawodowa'] . ",'".$_POST['name']."','".$_POST['surname']."',0)") === TRUE) {
                        echo '<script>
                        document.getElementById("grupaZawodowa").classList.add("good");
                        document.getElementById("login").classList.add("good");
                        document.getElementById("name").classList.add("good");
                        document.getElementById("surname").classList.add("error");
                        document.getElementById("mail").classList.add("good");
                        document.getElementById("password").classList.add("good");
                        document.getElementById("repassword").classList.add("good");
                        document.getElementById("passErr").style.color = "#0f0";
                        document.getElementById("passErr").innerHTML = "Utworzono użytkownika<br>" </script>';
                    } else {
                        echo '<script>
                        document.getElementById("grupaZawodowa").classList.add("error");
                        document.getElementById("login").classList.add("error");
                        document.getElementById("name").classList.add("error");
                        document.getElementById("surname").classList.add("error");
                        document.getElementById("mail").classList.add("error");
                        document.getElementById("password").classList.add("error");
                        document.getElementById("repassword").classList.add("error");
                        document.getElementById("passErr").innerHTML = "Wystąpił błąd przetwarzania backend <br>' . $conn->error . '" </script>';
                    }
                } else {
                    echo '
        <script>
        document.getElementById("login").classList.add("error");
        document.getElementById("mail").classList.add("error");
        document.getElementById("passErr").innerHTML = "Nazwa użytkownika lub email zajęty<br>";
        </script>
        ';
                }
                $conn->close();
            }
        }
    } else {
        echo '
        <script>
        document.getElementById("grupaZawodowa").classList.add("error");
                        document.getElementById("login").classList.add("error");
                        document.getElementById("name").classList.add("error");
                        document.getElementById("surname").classList.add("error");
                        document.getElementById("mail").classList.add("error");
                        document.getElementById("password").classList.add("error");
                        document.getElementById("repassword").classList.add("error");
        document.getElementById("passErr").innerHTML = "Wprowadź pełne dane<br>";
        </script>
        ';
    }
}
?>