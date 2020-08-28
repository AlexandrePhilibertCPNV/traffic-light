<?php

$red = false;
$yellow = false;
$green = false;

switch ($_GET['state']) {
    case 1:
        $yellow = true;
    case 0:
        $red = true;
        break;
    case 2:
        $green = true;
        break;
    case 3:
        $yellow = true;
        break;
    default:
        $red = true;
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="traffic-light">
        <div class="bulb bulb-red <?= $red ? '' : 'bulb-off' ?>"></div>
        <div class="bulb bulb-yellow <?= $yellow ? '' : 'bulb-off' ?>"></div>
        <div class="bulb bulb-green <?= $green ? '' : 'bulb-off' ?>"></div>
    </div>
    <a href="/?state=<?= isset($_GET['state']) ? ($_GET['state'] + 1) % 4 : 1 ?>">=></a>
</body>

</html>