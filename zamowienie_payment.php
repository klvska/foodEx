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
$products = array();
$query = "SELECT produkt_id FROM koszyk WHERE uzytkownik_id = $id_user";
$result = mysqli_query($connection, $query);
while($row = mysqli_fetch_array($result)){
    $product_id = $row['produkt_id'];
    $products[] = $product_id;
}

if($dostawa == "restauracja"){
    echo $selected_address;
    echo $totalsum;
    echo $totalQuantity;
    $query = "INSERT INTO zamowienia (Cena, id_adresu, ilosc_dan, id_restauracji, id_user) VALUES ('$totalsum', '0', '$totalQuantity', '$selected_address', '$id_user')";
    $result = mysqli_query($connection, $query);
}else if($dostawa == "dom"){
    echo $selected_address;
    echo $totalsum;
    echo $totalQuantity;
    $query = "INSERT INTO zamowienia (Cena, id_adresu, ilosc_dan, id_restauracji, id_user) VALUES ('$totalsum', '$selected_address', '$totalQuantity', '0', '$id_user')";
    $result = mysqli_query($connection, $query);
}



