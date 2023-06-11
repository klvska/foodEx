<?php

session_start();

if (!isset($_SESSION['udanarejestracja']))
{
    header('Location: login.php');
    exit();
}
else
{
    unset($_SESSION['udanarejestracja']);
}

if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);


?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Jedzenie</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');

        body {
            background-color: #F7F7F7;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'Ubuntu', sans-serif;
            font-weight: 700;
            text-align: center;
        }

        h1 {
            font-size: 54px;
            margin-bottom: 20px;
        }

        a {
            color: #F07F00;
            font-size: 24px;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #F07F00;
        }
    </style>
</head>

<body>
    <h1>Dziękujemy za rejestrację w sklepie! Możesz już zalogować się na swoje konto!</h1>

    <a href="login.php">Zaloguj się na swoje konto!</a>
</body>
</html>

    <title>Jedzenie</title>
</head>

<body>

Dziękujemy za rejestrację w sklepie! Możesz już zalogować się na swoje konto!<br /><br />

<a href="./login.php">Zaloguj się na swoje konto!</a>
<br /><br />

</body>
</html>
