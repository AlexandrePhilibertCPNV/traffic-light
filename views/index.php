<?php 
    require_once 'classes/TrafficLight.php';
?>

<div class="traffic-light">
    <div class="bulb <?= $traffic_light->red ? 'bulb-red' : '' ?>"></div>
    <div class="bulb <?= $traffic_light->yellow ? 'bulb-yellow' : '' ?> <?= $traffic_light->state == LightState::PAUSE ? 'bulb-blinking' : '' ?>"></div>
    <div class="bulb <?= $traffic_light->green ? 'bulb-green' : '' ?>"></div>
</div>
<a href="/?next">=></a>
<?= $traffic_light->is_next_state_allowed(LightState::PAUSE) ? '' : '<a href="/?pause">!</a>' ?>
