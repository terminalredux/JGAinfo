<?php
use App\Components\OpenWeatherMap\OpenWeatherMap;
$weather = new OpenWeatherMap();
?>
<h1>Witamy na stronie !</h1>
<div class="row">
  <div class="col-md-6">
  </div>
  <div class="col-md-6">
    <h2>Pogoda</h2>
    <br><br>
    <div class="row">
        <div class="col-md-6">
          <div class="weather-group">
            <img src="<?= $weather->weatherImg() ?>" alt="pogoda" title="pogoda" class="weather-img">
            <p>Zachmurzenie: <span><?= $weather->clouds() ?></span></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="weather-group">
            <img src="<?=  URL . 'web/img/044-temperature-2.png' ?>" alt="pogoda" title="pogoda" class="weather-img">
            <p>Temperatura: <span><?= $weather->temp() ?></span></p>
          </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
          <div class="weather-group">
            <img src="<?=  URL . 'web/img/024-windy-1.png' ?>" alt="pogoda" title="pogoda" class="weather-img">
            <p>Prędkość wiatru: <span><?= $weather->windSpeed() ?></span></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="weather-group">
            <img src="<?=  URL . 'web/img/002-drop.png' ?>" alt="pogoda" title="pogoda" class="weather-img">
            <p>Wilgotność powietrza: <span><?= $weather->humidity() ?></span></p>
          </div>
        </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <div class="weather-group">
          <img src="<?= URL . 'web/img/pressure.png' ?>" alt="pogoda" title="pogoda" class="weather-img">
          <p>Ciśnienie: <span><?= $weather->pressure() ?></span></p>
        </div>
      </div>
      <div class="col-md-6">
      </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
          <div class="weather-group">
            <img src="<?=  URL . 'web/img/033-sunrise.png' ?>" alt="pogoda" title="pogoda" class="weather-img">
            <p>Wschód: <span><?= $weather->sunrise() ?></span></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="weather-group">
            <img src="<?=  URL . 'web/img/034-moon.png' ?>" alt="pogoda" title="pogoda" class="weather-img">
            <p>Zachód: <span><?= $weather->sunset() ?></span></p>
          </div>
        </div>
    </div>






  </div>
</div>
