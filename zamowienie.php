<?php
require_once "connection.php";


session_start();
if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']!=true))
{
    header('Location: logowanie/login.php');
    exit();
}


$uzytkownik_id = $_SESSION['id'];


$sql = "SELECT * FROM koszyk WHERE uzytkownik_id = $uzytkownik_id";
$result = $connection->query($sql);

?>



