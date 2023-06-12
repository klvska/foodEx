<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Podsumowanie zamówienia</title>
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
            height: 500px;
        }

        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            margin: 5px 0;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 5px;
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

        .empty-cart {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }
        .zamow-container{
            font-size: 20px;
        }
        #zamow{
            margin-top: 20px;
            width: 100%;
            height: 45px;
        }
    </style>
</head>
<body>
<?php
        session_start();
        require_once "connection.php";
        require_once "nav.php";
        ?>
    <div class="container">
        <?php

        if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] != true)) {
            header('Location: logowanie/login.php');
            exit();
        }

        $uzytkownik_id = $_SESSION['id'];
        $sql = "SELECT id,nazwa, cena, SUM(ilosc) as suma_ilosci FROM koszyk WHERE uzytkownik_id = $uzytkownik_id GROUP BY nazwa, cena";
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

            echo "<div class='zamow-container'><p>Suma: " . $totalSum . "</p>";
            echo "<p>Ilość produktów: " . $totalQuantity . "</p></div>";

            echo "<h2>Wybierz formę dostawy:</h2>";
            echo '<form action="zamowienie_action.php" method="POST">';
            echo '<input type="hidden" name="totalSum" value="' . $totalSum . '">';
            echo '<input type="hidden" name="totalQuantity" value="' . $totalQuantity . '">';
            echo '<label for="dostawa">Dostawa do domu:</label>';
            echo '<input type="radio" id="dostawa" name="dostawa" value="dom">';
            echo '<br>';
            echo '<label for="dostawa">Odbiór w restauracji:</label>';
            echo '<input type="radio" id="dostawa" name="dostawa" value="restauracja">';
            echo '<br>';
            echo '<input id="zamow" type="submit" value="Przejdź do dostawy">';
            echo '</form>';
        } else {
            echo '<p class="empty-cart">Koszyk jest pusty.</p>';
        }

        $connection->close();
        ?>
    </div>
</body>
</html>
