<?php
namespace App\Components\Parsers\Jelonka;

use App\Components\Parsers\AbstractDetailsParser;
use App\Components\Parsers\Models\SingleNews;
use App\Components\DateTimeHelper\DateTimeHelper;
use DateTime;

class DetailsParserJelonka extends AbstractDetailsParser
{
  private const XPATH_TITLE = "//a[@class='wiadomosci-title']";
  private const XPATH_CONTENT = "//div[@class='wiadomosci-contener']";
  private const XPATH_PUBDATETIME = "//div[@class='wiadomosci-data']/strong";
  private const XPATH_UPDATEDATETIME = "//div[@class='wiadomosci-data'][1]";
  private const XPATH_AUTHOR = "//span[@class='autor']/span/strong";
  private const XPATH_MAINPHOTO = "//img[@class='wiadomosc-img']/@src";

  private $xPath;
  private $news;

  /**
   * @inheritdoc
   */
  protected function parseTitle() : void {
    $title = $this->xPath->query(self::XPATH_TITLE);
    $this->news->setTitle($title[0]->nodeValue);
  }

  /**
   * @inheritdoc
   */
  protected function parseContent() : void {
    $content = $this->xPath->query(self::XPATH_CONTENT);
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
    $pubDateTime = $this->xPath->query(self::XPATH_PUBDATETIME);
    $this->news->setPubDateTime($this->preparePubDateTime($pubDateTime[0]->nodeValue));
  }

  /**
   * Optional element to parse
   * Used in superclass template method parse($url, $flags)
   * Parse and sets SingleNews author
   */
  protected function parseAuthor() : void {
    $author = $this->xPath->query(self::XPATH_AUTHOR);
    $this->news->setAuthor($author[0]->nodeValue);
  }

  /**
   * Optional element to parse. Check if in news there is a main photo
   * Used in superclass template method parse($url, $flags)
   * Parse and sets SingleNews mainPhoto
   */
  protected function parseMainPhoto() : void {
    if ($this->xPath->evaluate(self::XPATH_MAINPHOTO)->length) {
      $mainPhoto = $this->xPath->query(self::XPATH_MAINPHOTO);
      $this->news->setMainPhoto($mainPhoto[0]->nodeValue);
    }
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
