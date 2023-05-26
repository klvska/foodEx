<?php
session_start();

if (isset($_POST['email'])) {

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
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email)) {
        $wszystko_OK = false;
        $_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
    }
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
    if ((strlen($haslo1) < 8) || (strlen($haslo1) > 20)) {
        $wszystko_OK = false;
        $_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków!";
    }

    if ($haslo1 != $haslo2) {
        $wszystko_OK = false;
        $_SESSION['e_haslo'] = "Podane hasła nie są identyczne!";
    }
    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
    if (!isset($_POST['regulamin'])) {
        $wszystko_OK = false;
        $_SESSION['e_regulamin'] = "Potwierdź akceptację regulaminu!";
    }
    $_SESSION['fr_nick'] = $nick;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;
    if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

    require_once "../conn.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($localhost, $user, $password, $database);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            $rezultat = $polaczenie->query("SELECT id FROM dane WHERE email='$email'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_maili = $rezultat->num_rows;
            if ($ile_takich_maili > 0) {
                $wszystko_OK = false;
                $_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu e-mail!";
            }

            $rezultat = $polaczenie->query("SELECT id FROM dane WHERE user='$nick'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_nickow = $rezultat->num_rows;
            if ($ile_takich_nickow > 0) {
                $wszystko_OK = false;
                $_SESSION['e_nick'] = "Istnieje już użytkownik o takim nicku";
            }

            if ($wszystko_OK == true) {


                if ($polaczenie->query("INSERT INTO dane VALUES (NULL, '$nick', '$haslo_hash', '$email', 'false')")) {
                    $_SESSION['udanarejestracja'] = true;
                    header('Location: witamy.php');
                } else {
                    throw new Exception($polaczenie->error);
                }
            }

            $polaczenie->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera!</span>';
        echo '<br/>Inf ' . $e;
    }
}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Załóż konto</title>
</head>

<body>

    <form method="post">

        <input type="text" value="<?php
                                    if (isset($_SESSION['fr_nick'])) {
                                        echo $_SESSION['fr_nick'];
                                        unset($_SESSION['fr_nick']);
                                    }
                                    ?>" name="nick" placeholder="Login" /><br>

        <?php
        if (isset($_SESSION['e_nick'])) {
            echo '<div class="error">' . $_SESSION['e_nick'] . '</div>';
            unset($_SESSION['e_nick']);
        }
        ?>
        <input type="text" value="<?php
                                    if (isset($_SESSION['fr_email'])) {
                                        echo $_SESSION['fr_email'];
                                        unset($_SESSION['fr_email']);
                                    }
                                    ?>" name="email" placeholder="Email" /><br>

        <?php
        if (isset($_SESSION['e_email'])) {
            echo '<div class="error">' . $_SESSION['e_email'] . '</div>';
            unset($_SESSION['e_email']);
        }
        ?>

        <input type="password" value="<?php
                                        if (isset($_SESSION['fr_haslo1'])) {
                                            echo $_SESSION['fr_haslo1'];
                                            unset($_SESSION['fr_haslo1']);
                                        }
                                        ?>" name="haslo1" placeholder="Hasło" /><br>

        <?php
        if (isset($_SESSION['e_haslo'])) {
            echo '<div class="error">' . $_SESSION['e_haslo'] . '</div>';
            unset($_SESSION['e_haslo']);
        }
        ?>

        <input type="password" value="<?php
                                        if (isset($_SESSION['fr_haslo2'])) {
                                            echo $_SESSION['fr_haslo2'];
                                            unset($_SESSION['fr_haslo2']);
                                        }
                                        ?>" name="haslo2" placeholder="Powtórz hasło" /><br>

        <label>
            <input type="checkbox" name="regulamin" <?php
                                                    if (isset($_SESSION['fr_regulamin'])) {
                                                        echo "checked";
                                                        unset($_SESSION['fr_regulamin']);
                                                    }
                                                    ?> /> Akceptuję regulamin
        </label>

        <?php
        if (isset($_SESSION['e_regulamin'])) {
            echo '<div class="error">' . $_SESSION['e_regulamin'] . '</div>';
            unset($_SESSION['e_regulamin']);
        }
        ?>
        <br>

        <input type="submit" value="Zarejestruj się" />

    </form>

</body>

</html>