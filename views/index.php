<?php
require_once 'classes/TrafficLight.php';
?>

<div id="traffic-light" class="traffic-light" data-state="<?= $traffic_light->get_state() ?>">
    <div class="bulb <?= $traffic_light->red ? 'bulb-red' : '' ?>"></div>
    <div class="bulb <?= $traffic_light->yellow ? 'bulb-yellow' : '' ?> <?= $traffic_light->state == LightState::PAUSE ? 'bulb-blinking' : '' ?>"></div>
    <div class="bulb <?= $traffic_light->green ? 'bulb-green' : '' ?>"></div>
</div>
<a href="/?next">=></a>
<?= $traffic_light->is_next_state_allowed(LightState::PAUSE) ? '' : '<a href="/?pause">!</a>' ?>

<script>
    // Self-invoking function
    (() => {
        let trafficLight = document.getElementById('traffic-light');
        let timeout = 0;

        switch (trafficLight.getAttribute('data-state')) {
            case 'pause':
                // Do not reload when in pause state
                return;
            case 'ready':
                timeout = 1;
                break;
            case 'go':
                timeout = 5;
                break;
            case 'slow':
                timeout = 1;
                break;
            case 'stop':
            default:
                timeout = 10;
                break;
        }

        setTimeout(() => {
            location.reload();
        }, timeout * 1000);
    })();
</script>