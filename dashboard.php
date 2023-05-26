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
        <title>Jedzenie</title>
    </head>
<body>
<?php
    require_once "./connection.php";

    $sql = "SELECT * FROM `uzytkownicy` WHERE id= '".$_SESSION['id']."'";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        echo "Witaj ".$row['user']."!";

    }
?>
</body>
</html>