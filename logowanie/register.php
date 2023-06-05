<?php
session_start();

if(isset($_POST['email'])) {

    $wszystko_OK = true;
    $nick = $_POST['nick'];
    if ((strlen($nick) < 3) || (strlen($nick) > 20)) {
        $wszystko_OK = false;
        $_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków!";
    }
    if (ctype_alnum($nick) == false) {
        $wszystko_OK = false;
        $_SESSION['e_nick'] = "Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
    }
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
        $wszystko_OK=false;
        $_SESSION['e_email']="Podaj poprawny adres e-mail!";
    }
    $haslo1 = $_POST['haslo1'];

    if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
    }

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    $_SESSION['fr_nick'] = $nick;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_haslo1'] = $haslo1;

    require_once "../connection.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try
    {

        if ($connection->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {

            $rezultat = $connection->query("SELECT id FROM uzytkownicy WHERE email='$email'");

            if (!$rezultat) throw new Exception($connection->error);

            $ile_takich_maili = $rezultat->num_rows;
            if($ile_takich_maili>0)
            {
                $wszystko_OK=false;
                $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
            }

            $rezultat = $connection->query("SELECT id FROM uzytkownicy WHERE Nazwa_uzytkownika='$nick'");

            if (!$rezultat) throw new Exception($connection->error);

            $ile_takich_nickow = $rezultat->num_rows;
            if($ile_takich_nickow>0)
            {
                $wszystko_OK=false;
                $_SESSION['e_nick']="Istnieje już użytkownik o takim nicku";
            }

            if ($wszystko_OK==true)
            {

                if ($connection->query("INSERT INTO uzytkownicy (imie,nazwisko,Nazwa_uzytkownika,email,Haslo,Administrator) VALUES ('','', '$nick','$email', '$haslo_hash','false')"))
                {
                    $_SESSION['udanarejestracja']=true;
                    header('Location: welcome.php');
                }
                else
                {
                    throw new Exception($connection->error);
                }
            }

            $connection->close();
        }

    }
    catch(Exception $e)
    {
        echo '<span style="color:red;">Błąd serwera!</span>';
       echo '<br />Inf '.$e;
    }
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Jedzenie-załóż-konto</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <style>
        .error
        {
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<form method="post">


    Nazwa użytkownika: <br> <input type="text" value="<?php
    if (isset($_SESSION['fr_nick']))
    {
        echo $_SESSION['fr_nick'];
        unset($_SESSION['fr_nick']);
    }
    ?>" name="nick" /><br>

    <?php
    if (isset($_SESSION['e_nick']))
    {
        echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
        unset($_SESSION['e_nick']);
    }
    ?>

    E-mail: <br> <input type="text" value="<?php
    if (isset($_SESSION['fr_email']))
    {
        echo $_SESSION['fr_email'];
        unset($_SESSION['fr_email']);
    }
    ?>" name="email" /><br>

    <?php
    if (isset($_SESSION['e_email']))
    {
        echo '<div class="error">'.$_SESSION['e_email'].'</div>';
        unset($_SESSION['e_email']);
    }
    ?>

    Twoje hasło: <br> <input type="password"  value="<?php
    if (isset($_SESSION['fr_haslo1']))
    {
        echo $_SESSION['fr_haslo1'];
        unset($_SESSION['fr_haslo1']);
    }
    ?>" name="haslo1" /><br>

    <?php
    if (isset($_SESSION['e_haslo']))
    {
        echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
        unset($_SESSION['e_haslo']);
    }
    ?>


    <br>
    <input type="submit" value="Zarejestruj się" />
    <br>
    <a href="login.php">Masz już konto</a>

</form>

</body>
</html>
