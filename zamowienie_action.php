<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Formularz dostawy</title>
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
            width: 150px;
            height: 35px;
            border-radius: 41px;
            margin-top: 10px;
        }

        .address-container {
            margin-bottom: 10px;
        }

        .address-container p {
            margin: 5px 0;
        }

        .empty-address {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
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
        

        $id_user = $_SESSION['id'];
        if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany'] != true)) {
            header('Location: logowanie/login.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dostawa = $_POST['dostawa'];

            if ($dostawa == 'dom') {
                $query = "SELECT a.Ulica, a.Nr_Domu_Mieszkania, a.Miasto, a.Kod_pocztowy
                  FROM `adresy` a
                  INNER JOIN `adresy_uzytkownicy` au ON a.id = au.id_adresu
                  WHERE au.id_user = '$id_user'";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    echo "<h1>Wybierz adres dostawy:</h1>";
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<form action='zamowienie_payment.php' method='post' class='address-container'>";
                        echo "<input type='radio' id='home' name='selected_address' value='" . $row['Ulica'] . "|" . $row['Nr_Domu_Mieszkania'] . "|" . $row['Miasto'] . "|" . $row['Kod_pocztowy'] . "'>";
                        echo "<p>Ulica: " . $row['Ulica'] . "</p>";
                        echo "<p>Nr domu/mieszkania: " . $row['Nr_Domu_Mieszkania'] . "</p>";
                        echo "<p>Miasto: " . $row['Miasto'] . "</p>";
                        echo "<p>Kod pocztowy: " . $row['Kod_pocztowy'] . "</p>";
                    }
                    echo "<input type='submit' name='submit' value='Przejdź do płatności'>";
                    echo "</form>";
                } else {
                    echo "<p class='empty-address'>Brak adresów.</p>";
                    echo "<p class='empty-address'><a href='dashboard.php'>Chcesz dodać adres? Kliknij tutaj</a></p>";
                }
            } else if ($dostawa == 'restauracja') {
                $sql = "SELECT `Miasto`, `nazwa_restauracji`, `lat`, `lng` FROM `restauracje`";
                $result = $connection->query($sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo "<form action='zamowienie_payment.php' method='post' class='address-container'>";
                    echo "<input type='radio' id='restaurant' name='selected_address' value='restauracja'>";
                    echo "<p>Miasto: " . $row['Miasto'] . "</p>";
                    echo "<p>Nazwa restauracji: " . $row['nazwa_restauracji'] . "</p>";
                }
                echo "<input type='submit' name='submit' value='Przejdź do płatności'>";
                echo "</form>";
            }

        } else {
            header('Location: index.php');
            exit();
        }
        ?>
    </div>
</body>
</html>
