<?php

require_once 'classes/TrafficLight.php';

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