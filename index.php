<?php

require_once './classes/traffic_light.php';

$state = isset($_GET['state']) ? $_GET['state'] : 0;

$traffic_light = new TrafficLight();
$traffic_light->set_state($state);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="traffic-light">
        <div class="bulb <?= $traffic_light->red ? 'bulb-red' : '' ?>"></div>
        <div class="bulb <?= $traffic_light->yellow ? 'bulb-yellow' : '' ?>"></div>
        <div class="bulb <?= $traffic_light->green ? 'bulb-green' : '' ?>"></div>
    </div>
    <a href="/?state=<?= $traffic_light->get_next_state($state) ?>">=></a>
</body>

</html>