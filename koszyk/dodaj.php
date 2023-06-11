<?php
session_start();
require_once "../connection.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $uzytkownik_id = $_SESSION['id'];
    $ilosc = 1;
    $nazwa = $_POST['nazwa'];
    $cena = $_POST['cena'];

    $checkSql = "SELECT * FROM `koszyk` WHERE `id_dan` = $id AND `uzytkownik_id` = $uzytkownik_id";
    $checkResult = $connection->query($checkSql);

    if ($checkResult && $checkResult->num_rows > 0) {
        // Produkt już istnieje w koszyku, zwiększ jego ilość o 1
        $updateSql = "UPDATE `koszyk` SET `ilosc` = `ilosc` + 1 WHERE `id_dan` = $id AND `uzytkownik_id` = $uzytkownik_id";
        $updateResult = $connection->query($updateSql);

        if ($updateResult) {
            echo "Produkt został dodany do koszyka.";
        } else {
            echo "Błąd podczas aktualizacji ilości produktu w koszyku.";
        }
    } else {
        // Produkt nie istnieje w koszyku, dodaj nowy wpis
        $insertSql = "INSERT INTO `koszyk` (`uzytkownik_id`, `produkt_id`, `nazwa`, `cena`, `ilosc`) VALUES ('$uzytkownik_id', '$id', '$nazwa', '$cena', '$ilosc')";
        $insertResult = $connection->query($insertSql);

        if ($insertResult) {
            echo "Produkt został dodany do koszyka.";
        } else {
            echo "Błąd podczas dodawania produktu do koszyka.";
        }
    }
} else {
    echo "Nieprawidłowe żądanie.";
}

$connection->close();
?>

