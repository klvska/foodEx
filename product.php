<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jedzenie</title>
    <style>
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
            color: #f07f00;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #f07f00;
            color: #ffffff;
            border: none;
            cursor: pointer;
            border-radius: 41px;
        }
    </style>
</head>
<body>
    <?php
require_once "nav.php";
    ?>
    <div class="container">
        <?php
        require_once "connection.php";


        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM `dania` WHERE `id` = $id";
            $result = $connection->query($sql);

            if ($row = $result->fetch_assoc()) {
                echo "<h1>Nazwa: " . $row['Nazwa'] . "</h1>";
                echo "<p>Cena: " . $row['Cena'] . "</p>";
                echo "<p>Wartość kaloryczna: " . $row['w_kaloryczna'] . "</p>";
                echo "<p>Alergeny: " . $row['alergeny'] . "</p>";

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
    </div>
</body>
</html>
