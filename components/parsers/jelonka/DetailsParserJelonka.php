<?php
namespace App\Components\Parsers\Jelonka;

use App\Components\Parsers\AbstractDetailsParser;
use App\Components\Parsers\Models\SingleNews;
use App\Components\DateTimeHelper\DateTimeHelper;
use DateTime;

class DetailsParserJelonka extends AbstractDetailsParser
{
  //http://rykowisko.jelonka.com/nadgorliwosc-gorsza-od-71502.html
  // Czasami jest na liście newsów RYKOWISKO
  //I wtedy wypierdala błąd
  private const XPATH_TITLE = "//a[@class='wiadomosci-title']";
  private const XPATH_CONTENT = "//div[@class='wiadomosci-contener']";
  private const XPATH_PUBDATETIME = "//div[@class='wiadomosci-data']/strong";
  private const XPATH_UPDATE_DATETIME = "//div[@class='wiadomosci-data'][1]";
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
   * Optional element to parse. Check first if in the news is a main photo
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
   * Optional element to parse. Check first if in news is a update datetime
   * Used in superclass template method parse($url, $flags)
   * Parse and sets SingleNews updateDateTime
   */
  protected function parseUpdateDateTime() : void {
    $updateDateTime = $this->xPath->query(self::XPATH_UPDATE_DATETIME);
    $value = $updateDateTime[0]->nodeValue;
    if (strpos($value, 'ostatnia aktualizacja:')) {
      $value = trim($value);
      $array = explode('ostatnia aktualizacja:', $updateDateTime[0]->nodeValue);
      $this->news->setuUpdateDateTime($this->prepareUpdateDateTime($array[1]));
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

  /**
   * Prepare update datetime
   */
  public function prepareUpdateDateTime($datetime) : int {
    $tmp = explode(' ', trim($datetime));
    $time = ltrim($tmp[1]);
      $hour = explode(':',$time)[0];    // leading zero
      $minute = explode(':',$time)[1];  // leading zero
    $date = ltrim($tmp[0]);
      $day = explode('-', $date)[0];    // leading zero
      $month = explode('-', $date)[1];  // leading zero
      $year = explode('-', $date)[2];
    $date = new DateTime($year . '-' . $month . '-' . $day . 'T' . $hour . ':' . $minute . ':00');
    return $date->getTimestamp();
  }


}
