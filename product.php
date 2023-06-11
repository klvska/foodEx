<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jedzenie</title>
</head>
<body>
<?php
require_once "connection.php";
require_once "nav.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM `dania` WHERE `id` = $id";
    $result = $connection->query($sql);

    if ($row = $result->fetch_assoc()) {
        echo "Nazwa: " . $row['Nazwa'] . "<br>";
        echo "Cena: " . $row['Cena'] . "<br>";
        echo "Wartość kaloryczna: " . $row['w_kaloryczna'] . "<br>";
        echo "Alergeny: " . $row['alergeny'] . "<br>";

        // Formularz dodawania do koszyka
        echo '<form action="koszyk/dodaj.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="hidden" name="nazwa" value="' . $row['Nazwa'] . '">';
        echo '<input type="hidden" name="cena" value="' . $row['Cena'] . '">';
        echo '<input type="submit" value="Dodaj do koszyka">';
        echo '</form>';
    } else {
        echo "Produkt o podanym ID nie został znaleziony.";
    }
} else {
    echo "Nieprawidłowe ID produktu.";
}
$connection->close();
?>
</body>
</html>
