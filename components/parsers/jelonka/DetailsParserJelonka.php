<?php
namespace App\Components\Parsers\Jelonka;

use App\Components\Parsers\AbstractDetailsParser;
use App\Components\Parsers\Models\SingleNews;
use App\Components\DateTimeHelper\DateTimeHelper;
use DateTime;

class DetailsParserJelonka extends AbstractDetailsParser
{
  private $xPaths = [
      'XPATH_TITLE' => "//a[@class='wiadomosci-title']",
      'XPATH_CONTENT' => "//div[@class='wiadomosci-contener']",
      'XPATH_PUBDATETIME' => "//div[@class='wiadomosci-data']/strong",
      'XPATH_UPDATEDATETIME' => "//div[@class='wiadomosci-data'][1]",
      'XPATH_AUTHOR' => "//span[@class='autor']/span/strong",
  ];

  private $xPath;
  private $news;

  /**
   * @inheritdoc
   */
  protected function parseTitle() : void {
    $title = $this->xPath->query($this->xPaths['XPATH_TITLE']);
    $this->news->setTitle($title[0]->nodeValue);
  }

  /**
   * @inheritdoc
   */
  protected function parseContent() : void {
    $content = $this->xPath->query($this->xPaths['XPATH_CONTENT']);
    $textContent = [];
    for ($i = 0; $i <= $content[0]->childNodes->length; $i++) {
      if (isset($content[0]->childNodes->item($i)->attributes) &&
          ($content[0]->childNodes->item($i)->attributes[0]->value == 'wiadomosc-h2-tekst' ||
          $content[0]->childNodes->item($i)->attributes[0]->value == 'wiadomosc-h1-tekst')) {
        $textContent[] = $content[0]->childNodes->item($i)->nodeValue;
      }
    }
    $this->news->setContent(implode('<br><br>', $textContent));
  }

  /**
   * @inheritdoc
   */
  protected function parsePubDateTime() : void {
    $pubDateTime = $this->xPath->query($this->xPaths['XPATH_PUBDATETIME']);
    $this->news->setPubDateTime($this->preparePubDateTime($pubDateTime[0]->nodeValue));
  }

  /**
   * @inheritdoc
   */
  protected function parseAuthor() : void {
    $author = $this->xPath->query($this->xPaths['XPATH_AUTHOR']);
    $this->news->setAuthor($author[0]->nodeValue);
  }

  /**
   * @inheritdoc
   */
   protected function getNews() : SingleNews {
     return $this->news;
   }

   /**
    * @inheritdoc
    */
   protected  function setNews($news) : void {
     $this->news = $news;
   }

   /**
    * @inheritdoc
    */
 	 protected  function setXPath($xPath) : void {
     $this->xPath = $xPath;
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
