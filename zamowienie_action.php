<?php
session_start();
require_once "connection.php";
require_once "nav.php";

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
            echo "Wybierz adres dostawy:<br>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<form action='zamowienie_payment.php' method='post'>";
                echo "<input type='radio' id='home' name='selected_address' value='" . $row['Ulica'] . "|" . $row['Nr_Domu_Mieszkania'] . "|" . $row['Miasto'] . "|" . $row['Kod_pocztowy'] . "'>";
                echo "Ulica: " . $row['Ulica'] . "<br>";
                echo "Nr domu/mieszkania: " . $row['Nr_Domu_Mieszkania'] . "<br>";
                echo "Miasto: " . $row['Miasto'] . "<br>";
                echo "Kod pocztowy: " . $row['Kod_pocztowy'] . "<br><br>";
                echo "<input type='submit' name='submit' value='Przejdź do płatności'>";
                echo "</form>";
            }
        } else {
            echo "Brak adresów.<br>";
            echo "<a href='dashboard.php'>Chcesz dodać adres? Kliknij tutaj</a>";
        }
    } else if ($dostawa == 'restauracja') {
        $sql = "SELECT `Miasto`, `nazwa_restauracji`, `lat`, `lng` FROM `restauracje`";
        $result = $connection->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            echo "<form action='zamowienie_payment.php' method='post'>";
        echo "<input type='radio' id='restaurant' name='selected_address' value='restauracja'>";
        echo "Miasto " . $row['Miasto'] . "<br>";
        echo "Nazwa restauracji " . $row['nazwa_restauracji'] . "<br>";
        echo "<input type='submit' name='submit' value='Przejdź do płatności'>";
        echo "</form>";
        }
    }

} else {
    header('Location: index.php');
    exit();
}
?>
