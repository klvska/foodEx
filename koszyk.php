<?php
session_start();
require_once "../connection.php";
$uzytkownik_id = $_SESSION['id'];
$sql = "SELECT nazwa, cena, SUM(ilosc) as suma_ilosci FROM koszyk WHERE uzytkownik_id = $uzytkownik_id GROUP BY nazwa, cena";
$result = $connection->query($sql);

if ($result === false) {
    die("Błąd zapytania SQL: " . $connection->error);
}

if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] != true)) {
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');

* {
  font-family: 'Ubuntu', sans-serif;
  font-style: normal;
  font-weight: 700;
}
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 43px;
        }

        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #f07f00;
            color: #ffffff;
            border: none;
            cursor: pointer;
            width: 100px;
            height: 25px;
            border-radius: 41px;
        }
        #zamow{
            width: 100%;
            height: 45px;
        }
        .zamow-container{
            text-align: center;
            font-size: 40px;
        }
    </style>
</head>
<body>
    <?php require "nav.php"; ?>
    <div class="container">
        <h1>Koszyk</h1>
        <?php
        $totalSum = 0;
        $totalQuantity = 0;

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<p>Nazwa: " . $row['nazwa'] . "</p>";
                echo "<p>Cena: " . $row['cena'] . "</p>";
                echo "<p>Ilość: " . $row['suma_ilosci'] . "</p>";

                $subtotal = $row['cena'] * $row['suma_ilosci'];
                $totalSum += $subtotal;
                $totalQuantity += $row['suma_ilosci'];
                echo "<form action=\"../koszyk/usun.php\" method=\"POST\">";
                echo "<input type=\"hidden\" name=\"nazwa\" value=\"" . $row['nazwa'] . "\">";
                echo "<input type=\"submit\" value=\"Usuń\">";
                echo "</form>";
            }
            echo "<div class='zamow-container'><p>Suma: " . $totalSum . "</p>";
            echo "<p>Ilość produktów: " . $totalQuantity . "</p></div>";
            echo '<form action="../zamowienie.php" method="POST">';
            echo '<input id="zamow" type="submit" value="Zamów">';
            echo '</form>';
        } else {
            echo "<p>Koszyk jest pusty.</p>";
        }

        

        $connection->close();
        ?>
    </div>
</body>
</html>
