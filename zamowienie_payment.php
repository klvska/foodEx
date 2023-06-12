<?php
session_start();
require_once "connection.php";
require_once "nav.php";

$id_user = $_SESSION['id'];
if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany'] != true)) {
    header('Location: logowanie/login.php');
    exit();
}

$totalsum = $_POST['totalSum'];
$totalQuantity = $_POST['totalQuantity'];
$selected_address = $_POST['selected_address'];
$dostawa = $_POST['dostawa'];

if($dostawa == "restauracja"){
    echo "<script>Dziękujemy za złożenie zamówienia.</script>";
    $query = "INSERT INTO zamowienia (Cena, id_adresu, ilosc_dan, id_restauracji, id_user,status) VALUES ('$totalsum', '0', '$totalQuantity', '$selected_address', '$id_user', 'nowe')";
    $result = mysqli_query($connection, $query);
    $sql = "DELETE FROM `koszyk` WHERE uzytkownik_id = '$id_user'";
    $result = mysqli_query($connection, $sql);
    echo "<script>location.href='sukces.php';</script>";
}else if($dostawa == "dom") {
    echo "<script>Dziękujemy za złożenie zamówienia.</script>";
    $query = "INSERT INTO zamowienia (Cena, id_adresu, ilosc_dan, id_restauracji, id_user,status) VALUES ('$totalsum', '$selected_address', '$totalQuantity', '0', '$id_user', 'nowe')";
    $result = mysqli_query($connection, $query);
    $sql = "DELETE FROM `koszyk` WHERE uzytkownik_id = '$id_user'";
    $result = mysqli_query($connection, $sql);
    echo "<script>location.href='sukces.php';</script>";
}



