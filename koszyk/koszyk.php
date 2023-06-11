<?php
require_once "../connection.php";
session_start();
$uzytkownik_id = $_SESSION['id'];
$sql = "SELECT * FROM koszyk WHERE uzytkownik_id = $uzytkownik_id";
$result = $connection->query($sql);

if ($result === false) {
    die("Błąd zapytania SQL: " . $connection->error);
}


if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']!=true))
{
    header('Location: ../logowanie/login.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Koszyk</title>
</head>
<body>
<h1>Koszyk</h1>

<?php
if ($result->num_rows > 0) {
    // Wyświetl produkty w koszyku
    while ($row = $result->fetch_assoc()) {
        echo "<p>Nazwa: " . $row['nazwa'] . "</p>";
        echo "<p>Cena: " . $row['cena'] . "</p>";
        echo "<p>Ilość: " . $row['ilosc'] . "</p>";
    }

    // Wyświetl przycisk do zamówienia
    echo '<form action="../zamowienie.php" method="POST">';
    echo '<input type="submit" value="Zamów">';
    echo '</form>';
} else {
    echo "<p>Koszyk jest pusty.</p>";
}

$connection->close();




?>
</body>
</html>
