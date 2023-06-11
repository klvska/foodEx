<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Lista produktów</title>
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

        a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            color: #000000;
            font-weight: bold;
        }

        a:hover {
            color: #f07f00;
        }

        .add-to-cart {
            display: inline-block;
            background-color: #f07f00;
            color: #ffffff;
            border: none;
            cursor: pointer;
            width: 150px;
            height: 35px;
            border-radius: 41px;
            text-align: center;
            text-decoration: none;
            line-height: 35px;
            font-size: 16px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    require "./connection.php";
    require_once "./nav.php";
    ?>
    <div class="container">
        <?php
        

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
            if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']!=true))
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

        echo "<h1>Lista produktów</h1>";

        while ($row = $result->fetch_assoc()) {
            echo "<a href='product.php?id=" . $row['id'] . "'>" . $row['Nazwa'] . "</a>";
            echo "<a href='?id=" . $row['id'] . "' class='add-to-cart'>Dodaj do koszyka</a><br><br>";
        }

        $connection->close();
        ?>
    </div>
</body>
</html>
