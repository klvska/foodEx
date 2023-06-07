<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
<div id="map" style="height: 400px;"></div>
<script>
    var map = L.map('map').setView([52.2297, 21.0122], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
</script>
</body>
</html>
<?php

$points = [
    ['name' => 'Warszawa', 'lat' => 52.2297, 'lng' => 21.0122],
    ['name' => 'Kraków', 'lat' => 50.0647, 'lng' => 19.9450],
    ['name' => 'Gdańsk', 'lat' => 54.3520, 'lng' => 18.6466],
    ['name' => 'Wrocław', 'lat' => 51.1079, 'lng' => 17.0385],
    ['name' => 'Poznań', 'lat' => 52.4064, 'lng' => 16.9252],
    ['name' => 'Zakopane', 'lat' => 49.2992, 'lng' => 19.9496],
    ['name' => 'Lublin', 'lat' => 51.2465, 'lng' => 22.5684],
    ['name' => 'Toruń', 'lat' => 53.0138, 'lng' => 18.5981],
    ['name' => 'Szczecin', 'lat' => 53.4289, 'lng' => 14.5530],
    ['name' => 'Białystok', 'lat' => 53.1325, 'lng' => 23.1688]
];


echo '<script>';
foreach ($points as $point) {
    echo 'L.marker([' . $point['lat'] . ', ' . $point['lng'] . ']).addTo(map).bindPopup("' . $point['name'] . '");';
}
echo '</script>';


?>
