<?php
use App\Components\OpenWeatherMap\OpenWeatherMap;
$weather = new OpenWeatherMap();
?>
<h1>Witamy na stronie !</h1>
<div class="row">
  <div class="col-md-6">
  </div>
  <div class="col-md-6">
    <i class="fa fa-cloud" aria-hidden="true"></i> Zachmurzenie <br>
    <i class="fa fa-thermometer-three-quarters" aria-hidden="true"></i> Temperatura: <?= $weather->temp() ?> <br>
    <i class="fa fa-tint" aria-hidden="true"></i> Wilgotność powietrza: <?= $weather->humidity() ?> <br>
    <i class="fa fa-sun-o" aria-hidden="true"></i> Wschód: <?= $weather->sunrise() ?> <br>
    <i class="fa fa-star" aria-hidden="true"></i> Zachód: <?= $weather->sunset() ?> <br>
    <i class="fa fa-star" aria-hidden="true"></i> Ciśnienie: <?= $weather->pressure() ?> <br>
    <i class="fa fa-star" aria-hidden="true"></i> Ciśnienie: <?= $weather->clouds() ?> <br>
    <h1>Wind speed <?= $weather->windSpeed() ?></h1>

  </div>
</div>
