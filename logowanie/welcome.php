<?php

session_start();

if (!isset($_SESSION['udanarejestracja'])) {
    header('Location: login.php');
    exit();
} else {
    unset($_SESSION['udanarejestracja']);
}

if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
if (isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
if (isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);

if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
if (isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
if (isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);

?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>FoodEx</title>
</head>

<body>

    <a href="login.php">Zaloguj się na swoje konto!</a>
    <br><br>

</body>

</html>