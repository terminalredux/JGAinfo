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
        //TODO better error handler
    }
    curl_close($ch);
    $this->data = json_decode($json);
  }

  /**
   * @return string source to image representation
   */
  public function weatherImg() : string {
    $img =  URL . 'web/img/';
    $clouds = $this->data->clouds->all;

    if ($clouds >= 0 && $clouds <= 10) {
      $img .= '050-sun.png';
    } else if ($clouds >= 11 && $clouds <= 50) {
      $img .= '003-cloudy-4.png';
    } else if ($clouds >= 51 && $clouds <= 89) {
      $img .= '005-cloudy-3.png';
    } else if ($clouds >= 90 && $clouds <= 100) {
      $img .= '049-clouds.png';
    }
    return $img;
  }

  public function windSpeed() : string {
    return $this->convertWindSpeed($this->data->wind->speed) . ' km/h';
  }

  /**
   * @return string source to image representation
   */
  public function windDegImg() : string {
    //TODO
    return 'sdg';
  }

  public function clouds() : string {
    return $this->data->clouds->all . '%';
  }

  public function pressure() : string {
    return round($this->data->main->pressure, 1) . ' hPa';
  }

  public function temp() : string {
    return $this->kelvinToCelsius($this->data->main->temp) . '&#xB0;C';
  }

  public function humidity() : string {
    return $this->data->main->humidity . '%';
  }

  public function sunrise() : string {
    return date('G:i', $this->data->sys->sunrise);
  }

  public function sunset() : string {
    return date('G:i', $this->data->sys->sunset);
  }

  private function kelvinToCelsius($temp) : int {
    if ( is_numeric($temp) ) {
      return round(($temp - 273.15));
    }
  }

  /**
   * Convert wind speed from metre
   * per second to km per hour
   * @param float $speed
   */
  private function convertWindSpeed($speed) : float {
    if (is_numeric($speed)) {
      return number_format(($speed * 3600) / 1000, 1);
    }
  }

  /**
   * TODO rain, storm, snow.....
   */
}
