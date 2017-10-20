<?php
use App\Components\OpenWeatherMap\OpenWeatherMap;

$weather = OpenWeatherMap::getInstance();
$weather2 = OpenWeatherMap::getInstance();

?>
<h1>Witamy na stronie !</h1>
<?= $weather->getData() ?>
<?= $weather->getRandom() ?>
<hr>
<?= $weather2->getData() ?>
<?= $weather2->getRandom() ?>
