<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
    header('Location: ../dashboard.php');
    exit();
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Jedzenie</title>
    <style>
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
  background: #F7F7F7;
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
  font-size: 4rem;
  letter-spacing: 2px;
  padding-bottom: 1.5rem;
  padding-top: 0.75rem;
  text-align: center;
}

#signup {
  color: black;
  font-size: 2rem;
  margin-top: 3rem;
  text-align: center;
}

span {
  color: #F07F00;
}

#submit-btn {
  background: #F07F00;
  border: none;
  border-radius: 43px;
  box-shadow: 0px 1px 8px #a61e50;
  cursor: pointer;
  color: white;
  height: 4.5rem;
  margin: 0 auto;
  margin-top: 3rem;
  transition: 0.25s;
  width: 80%;
  font-size: 2rem;
}

#submit-btn:hover {
  box-shadow: 0px 1px 18px #F07F00;
}

.form {
  display: flex;
  flex-direction: column;
}

.form-border {
  background: #F07F00;
  height: 1px;
  width: 100%;
}

.form-content {
  background: #F7F7F7;
  border: none;
  outline: none;
  padding-top: 14px;
  font-size: 2rem;
}

input {
  font-size: 2rem;
}

@media screen and (max-width: 768px) {
  #modal {
    max-width: 500px;
  }

  #modal-title {
    font-size: 3rem;
  }

  #submit-btn {
    height: 4rem;
    font-size: 1.8rem;
  }

  .form-content,
  input {
    font-size: 1.8rem;
  }
}

@media screen and (max-width: 480px) {
  #modal {
    max-width: 320px;
  }

  #modal-title {
    font-size: 2.5rem;
  }

  #submit-btn {
    height: 3.5rem;
    font-size: 1.6rem;
  }

  .form-content,
  input {
    font-size: 1.6rem;
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
        <h2>Zaloguj się</h2>
      </div>
      <form action="login_action.php" method="post" class="form">
        <label for="user-email" style="padding-top:13px">
          </label>
        <input id="user-email" class="form-content" type="text" name="login" autocomplete="on" required placeholder="E-mail"/>
        <div class="form-border"></div>
        <label for="user-password" style="padding-top:22px">
          </label>
        <input id="user-password" class="form-content" type="password" name="haslo" required placeholder="Hasło" />
        <div class="form-border"></div>
        <input id="submit-btn" type="submit" name="submit" value="Zaloguj" />
        <a href="register.php" id="signup">Nie masz konta? <span>Stwórz je!</span></a>
      </form>
    </div>
  </div>
<?php
if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

</body>
</html>
