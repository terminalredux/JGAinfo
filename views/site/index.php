<?php
use App\Components\OpenWeatherMap\OpenWeatherMap;

$weather = new OpenWeatherMap();

?>
<h1>Witamy na stronie !</h1>
<?= $weather->getData()->main->temp ?>
