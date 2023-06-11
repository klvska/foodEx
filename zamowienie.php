<?php
session_start();
require_once "connection.php";
require_once "nav.php";


if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] != true)) {
    header('Location: logowanie/login.php');
    exit();
}

$uzytkownik_id = $_SESSION['id'];
$sql = "SELECT nazwa, cena, SUM(ilosc) as suma_ilosci FROM koszyk WHERE uzytkownik_id = $uzytkownik_id GROUP BY nazwa, cena";
$result = $connection->query($sql);

if ($result === false) {
    die("Błąd zapytania SQL: " . $connection->error);
}

$totalSum = 0;
$totalQuantity = 0;

if ($result->num_rows > 0) {
    echo "<h1>Podsumowanie zamówienia</h1>";
    echo "<h2>Produkty w koszyku:</h2>";

    while ($row = $result->fetch_assoc()) {
        echo "<p>Nazwa: " . $row['nazwa'] . "</p>";
        echo "<p>Cena: " . $row['cena'] . "</p>";
        echo "<p>Ilość: " . $row['suma_ilosci'] . "</p>";

        $subtotal = $row['cena'] * $row['suma_ilosci'];
        $totalSum += $subtotal;
        $totalQuantity += $row['suma_ilosci'];
    }

    echo "<p>Suma: " . $totalSum . "</p>";
    echo "<p>Ilość produktów: " . $totalQuantity . "</p>";

    echo "<h2>Wybierz formę dostawy:</h2>";
    echo '<form action="zamowienie_action.php" method="POST">';
    echo '<label for="dostawa">Dostawa do domu:</label>';
    echo '<input type="radio" id="dostawa" name="dostawa" value="dom">';
    echo '<br>';
    echo '<label for="dostawa">Odbiór w restauracji:</label>';
    echo '<input type="radio" id="dostawa" name="dostawa" value="restauracja">';
    echo '<br>';
    echo '<input type="submit" value="Przejdź do dostawy">';
    echo '</form>';
} else {
    echo "<p>Koszyk jest pusty.</p>";
}

$connection->close();
?>
