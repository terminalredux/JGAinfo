<?php
namespace App\Components\Parsers\Jg24;

use App\Components\Parsers\AbstractListParser;
use App\Components\Parsers\Models\NewsListItem;
use App\Components\Parsers\Models\NewsList;
use DateTime;

class ListParserJG24 extends AbstractListParser
{
  /**
   * @property array $xPaths
   */
  protected $xPaths = [
    'XPATH_TITLES' => "//div[@class='news ']/div[@class='text']/h2/a[@class='title']",
    'XPATH_SHORTCONTENTS' => "//div[@class='news ']/div[@class='text']",
    'XPATH_AUTHORS' => "",
    'XPATH_THUMBNAILS' => "//div[@class='news ']/div[@class='text']/a/img/@src",
    'XPATH_LINKS' => "//div[@class='news ']/div[@class='text']/a/@href",
    'XPATH_PUBDATETIMES' => "//div[@class='news ']/div[@class='text']/span[1]"
  ];

  /**
   * @property string $url to parse
   */
  protected $url = 'http://jg24.pl/';

  /**
   * @inheritdoc
   */
  public function generateList($newsList) : array {
    $list = [];
    if ($newsList->validation(NewsList::NO_AUTHORS)) {
      for ($i = 0; $i < $newsList->getLength(); $i++) {
        $item = new NewsListItem();
        $item->setTitle($newsList->getTitle($i)->nodeValue);
        $item->setShortContent($newsList->getShortContent($i)->childNodes->item(3)->textContent);
        $item->setAuthor('');
        $item->setThumbnail(JG24_URL . $newsList->getThumbnail($i)->nodeValue);
        $item->setLink(JG24_URL . $newsList->getLink($i)->nodeValue);
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
