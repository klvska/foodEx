<head>
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
<?php
session_start();
require_once "../connection.php";

if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] != true)) {
    header('Location: ../logowanie/login.php');
    exit();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $uzytkownik_id = $_SESSION['id'];
    $ilosc = 1;
    $nazwa = $_POST['nazwa'];
    $cena = $_POST['cena'];

    $checkSql = "SELECT * FROM `koszyk` WHERE `id_dan` = $id AND `uzytkownik_id` = $uzytkownik_id";
    $checkResult = $connection->query($checkSql);

    if ($checkResult && $checkResult->num_rows > 0) {

        $updateSql = "UPDATE `koszyk` SET `ilosc` = `ilosc` + 1 WHERE `id_dan` = $id AND `uzytkownik_id` = $uzytkownik_id";
        $updateResult = $connection->query($updateSql);

        if ($updateResult) {
            echo "Produkt został dodany do koszyka.";
        } else {
            echo "Błąd podczas aktualizacji ilości produktu w koszyku.";
        }
    } else {

        $insertSql = "INSERT INTO `koszyk` (`uzytkownik_id`, `produkt_id`, `nazwa`, `cena`, `ilosc`) VALUES ('$uzytkownik_id', '$id', '$nazwa', '$cena', '$ilosc')";
        $insertResult = $connection->query($insertSql);

        if ($insertResult) {
            echo '<h1>Produkt został dodany do koszyka.</h1>';
            echo '<a href="koszyk.php">Zobacz koszyk!</a>';
        } else {
            echo "Błąd podczas dodawania produktu do koszyka.";
        }
    }
} else {
    echo "Nieprawidłowe żądanie.";
}

$connection->close();
?>

