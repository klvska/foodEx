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
    *{
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
  height: 643px;
  margin: 6rem auto 8.1rem auto;
  width: 690px;
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
  margin-top: 50px;
  text-align: center;
}
span{
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
input{
    font-size: 24px;
}

    
</style>
</head>

<body>
    <?php
    require 'nav.php';
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
