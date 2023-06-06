<?php
session_start();

if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']!=true))
{
    header('Location: logowanie/login.php');
    exit();
}

?>

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
    require_once "./connection.php";

    $sql = "SELECT * FROM `uzytkownicy` WHERE id= '".$_SESSION['id']."'";
    $result = mysqli_query($connection, $sql);

// Formularz zmiany danych
    while($row = mysqli_fetch_assoc($result))
    {
        echo "Witaj ".$row['Nazwa_Uzytkownika']."!";
        echo "<br>";
        echo '<a id="logout-b" href="logowanie/logout.php">Wyloguj się</a>';
        echo "<br>";
        echo "<form action='dashboard.php' method='post'>";
            echo "<input type='text' name='imie' value='".$row['Imie']."' placeholder='imie'>";
            echo "<input type='text' name='nazwisko' value='".$row['Nazwisko']."' placeholder='nazwisko' >";
            echo "<input type='text' name='nazwa_u' value='".$row['Nazwa_Uzytkownika']."'>";
            echo "<input type='text' name='email' value='".$row['email']."'>";
            echo "<input type='password' name='haslo' >";
        echo "<input type='submit' name='submit' value='Zmień'>";
    }

// Zmiana danych
if(isset($_POST['submit'])) {
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
            $hashed_password = password_hash($haslo, PASSWORD_DEFAULT);
            $query .= ", haslo='$hashed_password'";
        }else{
            echo "Hasło musi posiadać od 8 do 20 znaków.";
            exit;
        }
    }
    $query .= " WHERE id= '".$_SESSION['id']."'";
    if(mysqli_query($connection, $query)) {
        echo "Dane zostały zaktualizowane.";
    } else {
        echo "Wystąpił błąd podczas aktualizacji danych: " . mysqli_error($connection);
    }
}




?>
</body>
</html>


