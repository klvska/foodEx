<?php
session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
    header('Location: login.php');
    exit();
}

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
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        if ($rezultat = $connection->query(
            sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
                mysqli_real_escape_string($connection,$login))))
        {
            $ilu_userow = $rezultat->num_rows;
            if($ilu_userow>0)
            {
                $wiersz = $rezultat->fetch_assoc();

                if (password_verify($haslo, $wiersz['pass']))
                {
                    $_SESSION['zalogowany'] = true;
                    $_SESSION['id'] = $wiersz['id'];
                    $_SESSION['user'] = $wiersz['user'];
                    $_SESSION['isAdmin'] = $wiersz['isAdmin'];

                    unset($_SESSION['blad']);
                    $rezultat->free_result();
                    header('Location: ../dashboard.php');
                }
                else
                {
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: login.php');
                }

            } else {

                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: login.php');

            }

        }
        else
        {
            throw new Exception($connection->error);
        }

        $connection->close();
    }
}
catch(Exception $e)
{
    echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
    echo '<br />Informacja developerska: '.$e;
}
?>

