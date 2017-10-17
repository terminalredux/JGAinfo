<?php
namespace App\Components\Parsers\Jgora24;

use App\Components\Parsers\AbstractListParser;
use App\Components\Parsers\Models\NewsListItem;
use App\Components\Parsers\Models\NewsList;
use DateTime;

class ListParserJgora24 extends AbstractListParser
{
  /**
   * @property array $xPaths
   */
  protected $xPaths = [
    'XPATH_TITLES' => "//div[@class='block p10 wiecej_ogl']/div[2]",
    'XPATH_SHORTCONTENTS' => "//div[@class='block p10 wiecej_ogl']/div[3]/a",
    'XPATH_AUTHORS' => "",
    'XPATH_THUMBNAILS' => "//div[@class='block p10 wiecej_ogl']/div[1]/a/img/@src",
    'XPATH_LINKS' => "//div[@class='block p10 wiecej_ogl']/div[1]/a/@href",
    'XPATH_PUBDATETIMES' => "//div[@class='block p10 wiecej_ogl']/div[4]"
  ];

  /**
   * @property string $url to parse
   */
  protected $url = 'http://www.24jgora.pl/wiadomosci';

  /**
   * @inheritdoc
   */
  public function generateList($newsList) : array {
    $list = [];
    if ($newsList->validation(NewsList::NO_AUTHORS)) {
      for ($i = 0; $i < $newsList->getLength(); $i++) {
        $item = new NewsListItem();
        $item->setTitle($newsList->getTitle($i)->nodeValue);
        $item->setShortContent($newsList->getShortContent($i)->nodeValue);
        $item->setAuthor('');
        $item->setThumbnail(JGORA24_URL . $newsList->getThumbnail($i)->nodeValue);
        $item->setLink($newsList->getLink($i)->nodeValue);
        $item->setPubDateTime($this->preparePubDateTime($newsList->getPubDateTime($i)->nodeValue));
        $list[] = $item;
      }
    }
    return $list;
  }

  /**
   * @inheritdoc
   */
  protected function preparePubDateTime($datetime) : int {
    $tmp = explode(' ', trim($datetime));
    $time = $tmp[1];
      $hour = explode(':',$time)[0];    // leading zero
      $minute = explode(':',$time)[1];  // leading zero
    $date = $tmp[0];
      $day = explode('-', $date)[2];    // leading zero
      $month = explode('-', $date)[1];  // leading zero
      $year = explode('-', $date)[0];
    $date = new DateTime($year . '-' . $month . '-' . $day . 'T' . $hour . ':' . $minute . ':00');

    return $date->getTimestamp();
  }

}
