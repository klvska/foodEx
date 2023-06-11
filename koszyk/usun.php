<?php
require_once "../connection.php";

session_start();
if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']!=true))
{
    header('Location: ../logowanie/login.php');
    exit();
}
$uzytkownik_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nazwa'])) {
        $nazwaProduktu = $_POST['nazwa'];

        $deleteSql = "DELETE FROM koszyk WHERE nazwa = '$nazwaProduktu' AND uzytkownik_id = $uzytkownik_id";
        $deleteResult = $connection->query($deleteSql);

        if ($deleteResult === false) {
            die("Błąd zapytania SQL: " . $connection->error);
        }
    }
}

header("Location: koszyk.php");
exit();



