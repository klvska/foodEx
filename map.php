<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
<div id="map" style="height: 400px;"></div>
<script>
    var map = L.map('map').setView([52.237049, 19.017532], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

</script>
</body>
</html>
<?php

require_once "connection.php";

$sql = "SELECT `Miasto`, `nazwa_restauracji`, `lat`, `lng` FROM `restauracje`";
$result = $connection->query($sql);


$points = [];

while ($row = $result->fetch_assoc()) {
    $points[] = [
        'miasto' => $row['Miasto'],
        'name' => $row['nazwa_restauracji'],
        'lat' => $row['lat'],
        'lng' => $row['lng'],
    ];
}
/*
$points = [
    ['miasto' => 'Warszawa', 'name' => 'Kulinarny Krąg','lat' => 52.2297, 'lng' => 21.0122],
    ['miasto' => 'Kraków', 'name' => 'Smakowita Kraina', 'lat' => 50.0647, 'lng' => 19.9450],
    ['miasto' => 'Gdańsk', 'name' => 'Morskie Delikatesy','lat' => 54.3520, 'lng' => 18.6466],
    ['miasto' => 'Wrocław','name' => 'Wrocławskie Kąski', 'lat' => 51.1079, 'lng' => 17.0385],
    ['miasto' => 'Poznań', 'name' => 'Poznańska Trucizna','lat' => 52.4064, 'lng' => 16.9252],
    ['miasto' => 'Zakopane','name' => 'Smakoszów Szczyt', 'lat' => 49.2992, 'lng' => 19.9496],
    ['miasto' => 'Lublin','name' => 'Smaki Wiecznego Miasto', 'lat' => 51.2465, 'lng' => 22.5684],
    ['miasto' => 'Toruń', 'name' => 'Toruńska Wytwornia Smaków','lat' => 53.0138, 'lng' => 18.5981],
    ['miasto' => 'Szczecin','name' => 'Kulinarna Przystań', 'lat' => 53.4289, 'lng' => 14.5530],
    ['miasto' => 'Białystok','name' => 'Restauracja Białostocka', 'lat' => 53.1325, 'lng' => 23.1688]
];
*/


echo '<script>';
foreach ($points as $point) {
    echo 'L.marker([' . $point['lat'] . ', ' . $point['lng'] . ']).addTo(map).bindPopup("' .  $point['miasto'] ."<br>". $point['name'] .'");';
}
echo '</script>';

?>