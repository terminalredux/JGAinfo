<?php
namespace App\Components\Parsers\Jgora24;

use App\Components\Parsers\AbstractDetailsParser;
use App\Components\Parsers\Models\SingleNews;
use DateTime;

class DetailsParserJgora24 extends AbstractDetailsParser
{
  private const XPATH_TITLE = "//h1[@class='artykul_tytul']";
  private const XPATH_CONTENT = "//div[@class='artykul_tresc_bold']";
  private const XPATH_PUBDATETIME = "//div[@class='artykul_podtytul_data block']";
  private const XPATH_MAINPHOTO = "//div[@class='artykul_tresc_fotogl']/img/@src";

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

    for ($i = 0; $i < $content[0]->childNodes->length; $i++) {
      $node = $content[0]->childNodes->item($i);
      // 3 means TEXT NODE
      if ($node->nodeType == 3 && !empty(trim($node->wholeText))) {
        $textContent[] = trim($node->wholeText);
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
   * Optional element to parse. Check first if in the news is a main photo
   * Used in superclass template method parse($url, $flags)
   * Parse and sets SingleNews mainPhoto
   */
  protected function parseMainPhoto() : void {
    if ($this->xPath->evaluate(self::XPATH_MAINPHOTO)->length) {
      $mainPhoto = $this->xPath->query(self::XPATH_MAINPHOTO);
      $this->news->setMainPhoto(JGORA24_URL. $mainPhoto[0]->nodeValue);
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
