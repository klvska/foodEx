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
echo '<script>';
foreach ($points as $point) {
    echo 'L.marker([' . $point['lat'] . ', ' . $point['lng'] . ']).addTo(map).bindPopup("' .  $point['miasto'] ."<br>". $point['name'] .'");';
}
echo '</script>';

?>