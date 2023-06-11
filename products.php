<?php
require_once "connection.php";


$sql = "SELECT * FROM `dania`";
$result = $connection->query($sql);

if ($result === false) {
    die("Błąd zapytania SQL: " . $connection->error);
}

while ($row = $result->fetch_assoc()) {
    echo "<a href='product.php?id=" . $row['id'] . "'>" . $row['Nazwa'] . "</a><br>";
    echo "<a href='koszyk/dodaj.php?id=" . $row['id'] . "'>Dodaj do koszyka</a><br><br>";
}

$connection->close();
?>