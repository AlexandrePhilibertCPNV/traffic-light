<?php

require_once 'classes/TrafficLight.php';

session_start();

$traffic_light = new TrafficLight();
$traffic_light->last_state = $_SESSION['last_state'];

if (isset($_GET['next'])) {
    $_SESSION['last_state'] = $traffic_light->set_next_state();
} else if (isset($_GET['pause'])) {
    $_SESSION['last_state'] = $traffic_light->set_next_state(LightState::PAUSE);
} else {
    // Set the default state
    $_SESSION['last_state'] = $traffic_light->set_next_state(LightState::STOP);
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="traffic-light">
        <div class="bulb <?= $traffic_light->red ? 'bulb-red' : '' ?>"></div>
        <div class="bulb <?= $traffic_light->yellow ? 'bulb-yellow' : '' ?> <?= $traffic_light->state == LightState::PAUSE ? 'bulb-blinking' : '' ?>"></div>
        <div class="bulb <?= $traffic_light->green ? 'bulb-green' : '' ?>"></div>
    </div>
    <a href="/?next">=></a>
    <a href="/?pause">!</a>
</body>

</html>