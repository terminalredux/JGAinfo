<?php
namespace App\Components\OpenWeatherMap;

class OpenWeatherMap
{
  private $data;

  public function __construct() {
    $url = sprintf(OPEN_WEATHER_MAP_URL, OPEN_WEATHER_MAP_JG_ID, OPEN_WEATHER_MAP_API_KEY);
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
    $json = curl_exec($ch);
    if(!$json) {
        echo curl_error($ch);
    }
    curl_close($ch);
    $this->data = json_decode($json);
  }

  public function getData() {
    return $this->data;
  }
}
