<?php
namespace App\Components\DateTimeHelper;

class DateTimeHelper
{
  private static $months = [
    'stycznia' => '01',
    'lutego' => '02',
    'marca' => '03',
    'kwietnia' => '04',
    'maja' => '05',
    'czerwca' => '06',
    'lipca' => '07',
    'sierpnia' => '08',
    'września' => '09',
    'października' => '10',
    'listopada' => '11',
    'grudnia' => '12'
  ];

  public static function getMonths() {
    return static::$months;
  }
}
