<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
    header('Location: dashboard.php');
    exit();
}

?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Logowanie</title>
</head>

<body>

    <form action="zaloguj.php" method="post">
        <input type="text" name="login" placeholder="Login" /><br>
        <input type="password" name="haslo" placeholder="Hasło" /><br>
        <input type="submit" value="Zaloguj się" /><br>
        <p>Nie masz konta?</p>
        <button><a href="rejestracja.php">Zarejestruj się</a></button>

    </form>

    <?php
    if (isset($_SESSION['blad'])) {
        echo $_SESSION['blad'];
    }
    ?>

</body>

</html>