<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="products.css">
    <title>Document</title>
</head>
<body>
    <?php
    ob_start();
    session_start();
    require 'nav.php';
    ?>
<form class="wyszukaj" action="products.php.php" method="post">
<input class="wyszukaj1" name="wyszukiwarka" type="text" placeholder="Wpisz aby wyszukać...">
<input type="image" src="img/lupa.jpg" alt="Wyszukaj" name="submit">
</form>
<p class="noco">Co dzisiaj zjesz?</p>
<div class="prop1">
<div class="propozycje"><p class="pr">Fastfood</p></div>
<div class="propozycje"><p class="pr">Kuchnia włoska</p></div>
<div class="propozycje"><p class="pr">Kuchnia chińska</p></div>
</div>
<?php
require_once "connection.php";
function dodajDoKoszyka($produktId)
{



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

        echo "<script> alert('Produkt $produktNazwa został dodany do koszyka.')</script>";
}

    if (isset($_GET["id"])) {
        $produktId = $_GET["id"];
        if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']!=true))
        {
            header('Location: logowanie/login.php');
            exit();
        }else{
            dodajDoKoszyka($produktId);
        }


    }


$sql = "SELECT * FROM `dania`";
$result = $connection->query($sql);

if ($result === false) {
die("Błąd zapytania SQL: " . $connection->error);
}
?>
<div class="produkty">
<?php
while ($row = $result->fetch_assoc()) {
    ?>
<div>
<?php
echo "<a class='pro' href='product.php?id=" . $row['id'] . "'>" . $row['Nazwa'] . "</a><br>";
echo "<a class='pro' href='?id=" . $row['id'] . "'><img class='pizza' src='img/pizza.jpg' alt='pizza'></a>";
?>
</div>
<?php
}
?>
</div>
<?php
$connection->close();
?>

    
</body>
</html>

