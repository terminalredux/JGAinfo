<?php
namespace App\Components\Parsers\Jelonka;

use App\Components\Parsers\AbstractDetailsParser;
use App\Components\Parsers\Models\SingleNews;
use App\Components\DateTimeHelper\DateTimeHelper;
use DateTime;

class DetailsParserJelonka extends AbstractDetailsParser
{
  /**
   * @param string $url to parse
   * @return SingleNews
   */
  public function parse($url) : SingleNews {
    $xpath = $this->getXPath($url);

    $detailNews = new SingleNews();

    $title = $xpath->query("//a[@class='wiadomosci-title']");
    $content = $xpath->query("//div[@class='wiadomosci-contener']");
    $pubDateTime = $xpath->query("//div[@class='wiadomosci-data']/strong");
    $updateDateTime = $xpath->query("//div[@class='wiadomosci-data'][1]");
    $author = $xpath->query("//span[@class='autor']/span/strong");

    //ostatnia aktualizacja:
    //if there is strong "ostatnia aktualizacja:" it means there was an update
    //trim(explode('ostatnia aktualizacja:', $updateDateTime[0]->nodeValue)[1])

    $textContent = [];
    for ($i = 0; $i <= $content[0]->childNodes->length; $i++) {
      if (isset($content[0]->childNodes->item($i)->attributes) &&
          ($content[0]->childNodes->item($i)->attributes[0]->value == 'wiadomosc-h2-tekst' ||
          $content[0]->childNodes->item($i)->attributes[0]->value == 'wiadomosc-h1-tekst')) {
        $textContent[] = $content[0]->childNodes->item($i)->nodeValue;
      }
    }

    $detailNews->setTitle($title[0]->nodeValue);
    $detailNews->setContent(implode('<br><br>', $textContent));
    $detailNews->setPubDateTime($this->preparePubDateTime($pubDateTime[0]->nodeValue));
    $detailNews->setAuthor($author[0]->nodeValue);

    //var_dump($detailNews->getTitle());die;
    return $detailNews;
  }

  /**
   * @inheritdoc
   */
  protected function preparePubDateTime($datetime) : int {
    $tmp = explode(',', $datetime);
    $time = ltrim($tmp[2]);
      $hour = explode(':',$time)[0];    // leading zero
      $minute = explode(':',$time)[1];  // leading zero
    $date = ltrim($tmp[1]);
      $day = explode(' ', $date)[0];    // leading zero
      $month = explode(' ', $date)[1];  // leading zero
      $year = explode(' ', $date)[2];
    $date = new DateTime($year . '-' . DateTimeHelper::getMonths()[$month] . '-' . $day . 'T' . $hour . ':' . $minute . ':00');

    return $date->getTimestamp();
  }
}
