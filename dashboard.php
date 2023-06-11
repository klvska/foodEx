<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Panel użytkownika</title>
    <link rel="stylesheet" href="dashboard.css">

</head>

<body>
<?php
        ob_start();
        session_start();
        require "nav.php";
?>
    <div class="container">
  <?php      
        

        if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany'] != true)) {
            header('Location: logowanie/login.php');
            exit();
        }

        require_once "connection.php";
        $id_user = $_SESSION['id'];
        $sql = "SELECT * FROM `uzytkownicy` WHERE id= '".$id_user."'";
        $result = mysqli_query($connection, $sql);

        // Formularz zmiany danych
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h1>Witaj ".$row['Nazwa_Uzytkownika']."!</h1>";
            echo '<a id="logout-b" href="logowanie/logout.php">Wyloguj się</a>';
            echo '<a href="index.php">Strona główna</a>';
            echo "<br>";
            echo "<form action='dashboard.php' method='post'>";
            echo "<input type='text' name='imie' value='".$row['Imie']."' placeholder='imie'>";
            echo "<input type='text' name='nazwisko' value='".$row['Nazwisko']."' placeholder='nazwisko'>";
            echo "<input type='text' name='nazwa_u' value='".$row['Nazwa_Uzytkownika']."'>";
            echo "<input type='text' name='email' value='".$row['email']."'>";
            echo "<input type='password' name='haslo'>";
            echo "<input type='submit' name='submit' value='Zmień'>";
            echo "</form>";
        }

        // Formularz dodawania adresu
        echo "<div class='adres-form'>";
        echo "<h2>Adres</h2>";
        echo "<form action='dashboard.php' method='post'>";
        echo "<input type='text' name='ulica' placeholder='Ulica' required>";
        echo "<input type='text' name='nr_domu' placeholder='Numer domu' required>";
        echo "<input type='text' name='miasto' placeholder='Miasto' required>";
        echo "<input type='text' name='kod_pocztowy' placeholder='kod pocztowy' required>";
        echo "<input type='submit' name='submit2' value='Dodaj'>";
        echo "</form>";
        echo "</div>";

        // Zmiana danych
        if (isset($_POST['submit'])) {
            $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $nazwa_u = $_POST['nazwa_u'];
    $email = $_POST['email'];
    $haslo = $_POST['haslo'];

    $query = "SELECT * FROM `uzytkownicy` WHERE Nazwa_Uzytkownika = '$nazwa_u' AND id != '".$_SESSION['id']."'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0) {
        echo "Nazwa użytkownika jest już zajęta.";
        exit;
    }
    $query = "SELECT * FROM `uzytkownicy` WHERE email = '$email' AND id != '".$_SESSION['id']."'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0) {
        echo "Adres e-mail jest już zajęty.";
        exit;
    }
    $query = "UPDATE `uzytkownicy` SET Imie='$imie', Nazwisko='$nazwisko', Nazwa_Uzytkownika='$nazwa_u', email='$email'";
    if(!empty($haslo)) {
        if ((strlen($haslo)<8) || (strlen($haslo)>20))
        {
            echo "Hasło musi posiadać od 8 do 20 znaków.";
            exit;
        }else{
            $hashed_password = password_hash($haslo, PASSWORD_DEFAULT);
            $query .= ", haslo='$hashed_password'";

        }
    }
    $query .= " WHERE id= '".$_SESSION['id']."'";
    if(mysqli_query($connection, $query)) {
        echo "Dane zostały zaktualizowane.";
    } else {
        echo "Wystąpił błąd podczas aktualizacji danych: " . mysqli_error($connection);
    }
}
        

        // Dodawanie adresu
        if (isset($_POST['submit2'])) {
            $ulica = $_POST['ulica'];
    $nr_domu = $_POST['nr_domu'];
    $miasto = $_POST['miasto'];
    $kod_pocztowy = $_POST['kod_pocztowy'];
    $query = "SELECT id FROM `adresy` WHERE Ulica = '$ulica' AND Nr_Domu_Mieszkania = '$nr_domu' AND Miasto = '$miasto' AND Kod_pocztowy = '$kod_pocztowy' AND id_user = '$id_user'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "Taki adres już istnieje.";
        exit;
    }else{
        $query = "INSERT INTO `adresy` (Ulica, Nr_Domu_Mieszkania, Miasto, Kod_pocztowy, id_user) VALUES ('$ulica', '$nr_domu', '$miasto', '$kod_pocztowy', '$id_user')";
        if (mysqli_query($connection, $query)) {
            $query = "SELECT id FROM `adresy` WHERE Ulica = '$ulica' AND Nr_Domu_Mieszkania = '$nr_domu' AND Miasto = '$miasto' AND Kod_pocztowy = '$kod_pocztowy' AND id_user = '$id_user'";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            $id_adresu = $row['id'];
            $query = "INSERT INTO `adresy_uzytkownicy` (id_adresu, id_user) VALUES ('$id_adresu', '$id_user')";
            if (mysqli_query($connection, $query)) {
                echo "Adres został dodany.";
            } else {
                echo "Wystąpił błąd podczas dodawania adresu: " . mysqli_error($connection);
            }
        } else {
            echo "Wystąpił błąd podczas aktualizacji danych: " . mysqli_error($connection);
        }
    }
        }

        $query = "SELECT a.Ulica, a.Nr_Domu_Mieszkania, a.Miasto, a.Kod_pocztowy
                  FROM `adresy` a
                  INNER JOIN `adresy_uzytkownicy` au ON a.id = au.id_adresu
                  WHERE au.id_user = '$id_user'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='adresy'>";
            echo "<h2>Wszystkie adresy:</h2>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='adres'>";
                echo "<p>Ulica: " . $row['Ulica'] . "</p>";
                echo "<p>Nr domu/mieszkania: " . $row['Nr_Domu_Mieszkania'] . "</p>";
                echo "<p>Miasto: " . $row['Miasto'] . "</p>";
                echo "<p>Kod pocztowy: " . $row['Kod_pocztowy'] . "</p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Brak adresów.</p>";
        }
        ?>
    </div>
</body>
</html>
