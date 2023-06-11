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
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');
    *{
        font-family: 'Ubuntu', sans-serif;
        font-style: normal;
        font-weight: 700;
    }
    a {
  text-decoration: none;
}


@import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');

* {
    font-family: 'Ubuntu', sans-serif;
    font-style: normal;
    font-weight: 700;
}

a {
    text-decoration: none;
}

#modal {
    background: #F7F7F7;;
    border-radius: 42px;
    box-shadow: 20px 20px 34px 5px rgba(0, 0, 0, 0.25);
    margin: 6rem auto 8.1rem auto;
    width: 690px;
    height: 730px;
}

#modal-content {
    padding: 12px 84px;
}

#modal-title {
    font-size: 54px;
    letter-spacing: 2px;
    padding-bottom: 23px;
    padding-top: 13px;
    text-align: center;
}

#signup {
    color: black;
    font-size: 24px;
    margin-top: 70px;
    text-align: center;
}

span {
    color:  #F07F00;
}

#submit-btn {
    background: #F07F00;
    border: none;
    border-radius: 43px;
    box-shadow: 0px 1px 8px #a61e50;
    cursor: pointer;
    color: white;
    height: 86px;
    margin: 0 auto;
    margin-top: 50px;
    transition: 0.25s;
    width: 339px;
    font-size: 36px;
}

#submit-btn:hover {
    box-shadow: 0px 1px 18px #F07F00;
}

.form {
    align-items: left;
    display: flex;
    flex-direction: column;
}

.form-border {
    background: #F07F00;
    height: 1px;
    width: 100%;
}

.form-content {
    background: #F7F7F7;;
    border: none;
    outline: none;
    padding-top: 14px;
}

input {
    font-size: 24px;
}

.error {
    color: red;
    margin-top: 10px;
    margin-bottom: 10px;
}

@media screen and (max-width: 768px) {
    #modal {
        margin: 3rem auto;
        width: 90%;
    }

    #modal-content {
        padding: 12px 40px;
    }

    #modal-title {
        font-size: 36px;
    }

    #submit-btn {
        height: 64px;
        width: 80%;
        font-size: 28px;
    }
}
    </style>
</head>

<body>
    <?php
    require '../nav.php';
    ?>
<div id="modal">
    <div id="modal-content">
      <div id="modal-title">
        <h2>Stwórz konto</h2>
      </div>
      <form method="post" class="form">
        <label for="user-nickname" stlye="padding-top:13px">
          </label>
        <input id="user-nickname" class="form-content" type="text" 
        value="<?php
        if (isset($_SESSION['fr_nick']))
        {
            echo $_SESSION['fr_nick'];
            unset($_SESSION['fr_nick']);
        }
        ?>" name="nick" required placeholder="Nazwa użytkownika"/>
        <div class="form-border"></div>
        <?php
        if (isset($_SESSION['e_nick']))
        {
            echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
            unset($_SESSION['e_nick']);
        }
        ?>
        <label for="user-email" style="padding-top:13px">
          </label>
        <input id="user-email" class="form-content" type="text"
        value="<?php
        if (isset($_SESSION['fr_email']))
        {
            echo $_SESSION['fr_email'];
            unset($_SESSION['fr_email']);
        }
        ?>"name="email" required placeholder="E-mail"/>
        <div class="form-border"></div>
        <?php
        if (isset($_SESSION['e_email']))
        {
            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
            unset($_SESSION['e_email']);
        }
        ?>
        <label for="user-password" style="padding-top:22px">
          </label>
        <input id="user-password" class="form-content" type="password"
        value="<?php
        if (isset($_SESSION['fr_haslo1']))
        {
            echo $_SESSION['fr_haslo1'];
            unset($_SESSION['fr_haslo1']);
        }
        ?>" name="haslo1"required placeholder="Hasło" />
        <div class="form-border"></div>
        <?php
        if (isset($_SESSION['e_haslo']))
        {
            echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
            unset($_SESSION['e_haslo']);
        }
        ?>
        <input id="submit-btn" type="submit" value="Zarejestruj się" />
        <a href="login.php" id="signup">Masz już konto? <span>Zaloguj się!</span></a>
      </form>
    </div>
  </div>


</body>
</html>
