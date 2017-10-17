<?php
namespace App\Components\Parsers\Jelonka;

use App\Components\Parsers\AbstractListParser;
use App\Components\Parsers\Models\NewsListItem;
use App\Components\DateTimeHelper\DateTimeHelper;
use DateTime;

class ListParserJelonka extends AbstractListParser
{
  /**
   * @property array $xPaths
   */
  protected $xPaths = [
    'XPATH_TITLES' => "//a[@class='news-title']",
    'XPATH_SHORTCONTENTS' => "//div[@class='tresc-one-news']",
    'XPATH_AUTHORS' => "//a[@class='autor-lista']",
    'XPATH_THUMBNAILS' => "//div[@class='list-contener']/table[@class='list-contener-table']/tr/td[1]/a/img/@src",
    'XPATH_LINKS' => "//div[@class='list-contener']/table[@class='list-contener-table']/tr/td[1]/a/@href",
    'XPATH_PUBDATETIMES' => "//div[@class='wiadomosci-data']"
  ];

  /**
   * @property string $url to parse
   */
  protected $url = 'http://www.jelonka.com/start,news,init,idModulu,154&nr=1';

  /**
   * @inheritdoc
   */
  public function generateList($newsList) : array {
    $list = [];
    if ($newsList->validation()) {
      for ($i = 0; $i < $newsList->getLength(); $i++) {
        $item = new NewsListItem();
        $item->setTitle($newsList->getTitle($i)->nodeValue);
        $item->setShortContent($newsList->getShortContent($i)->nodeValue);
        $item->setAuthor($newsList->getAuthor($i)->nodeValue);
        $item->setThumbnail($newsList->getThumbnail($i)->nodeValue);
        $item->setLink(JELONKA_URL . $newsList->getLink($i)->nodeValue);
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
    $tmp = explode(',', $datetime);
    $time = ltrim($tmp[1]);
      $hour = explode(':',$time)[0];    // leading zero
      $minute = explode(':',$time)[1];  // leading zero
    $date = ltrim($tmp[2]);
      $day = explode(' ', $date)[0];    // leading zero
      $month = explode(' ', $date)[1];  // leading zero
      $year = explode(' ', $date)[2];
    $date = new DateTime($year . '-' . DateTimeHelper::getMonths()[$month] . '-' . $day . 'T' . $hour . ':' . $minute . ':00');

    return $date->getTimestamp();
  }

}
