<?php
session_start();

if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']!=true))
{
    header('Location: ../logowanie/login.php');
    exit();
}

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Panel użytkownika</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<?php
require_once "./connection.php";





?>
</body>
</html>
