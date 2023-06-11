<?php
require_once "connection.php";

session_start();


function dodajDoKoszyka($produktId) {
    
global $connection;
$sql = "SELECT * FROM `dania` WHERE `id` = $produktId";
$result = $connection->query($sql);
if ($result === false || $result->num_rows === 0) {
die("Nieprawidłowy produkt.");
}


$row = $result->fetch_assoc();
$produktNazwa = $row['Nazwa'];
$produktCena = $row['Cena'];
$uzytkownikId = $_SESSION['id'];
$ilosc = 1;


$sql = "INSERT INTO `koszyk` (`uzytkownik_id`, `produkt_id`, `nazwa`, `cena`, `ilosc`)
VALUES ($uzytkownikId, $produktId, '$produktNazwa', $produktCena, $ilosc)";
$result = $connection->query($sql);
if ($result === false) {
die("Błąd podczas dodawania produktu do koszyka: " . $connection->error);
}

echo "Produkt \"$produktNazwa\" został dodany do koszyka.";
}


if (isset($_GET["id"])) {
$produktId = $_GET["id"];
dodajDoKoszyka($produktId);
}


$sql = "SELECT * FROM `dania`";
$result = $connection->query($sql);

if ($result === false) {
die("Błąd zapytania SQL: " . $connection->error);
}

while ($row = $result->fetch_assoc()) {
echo "<a href='product.php?id=" . $row['id'] . "'>" . $row['Nazwa'] . "</a><br>";
echo "<a href='?id=" . $row['id'] . "'>Dodaj do koszyka</a><br><br>";
}

$connection->close();
?>