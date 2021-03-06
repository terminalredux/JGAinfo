<?php
namespace App\Components\Parsers\Jg24;

use App\Components\Parsers\AbstractDetailsParser;
use App\Components\Parsers\Models\SingleNews;
use DateTime;
use DOMText;

class DetailsParserJG24 extends AbstractDetailsParser
{
  private const XPATH_TITLE = "//h1";
  private const XPATH_CONTENT = "//div[@id='text']";
  private const XPATH_PUBDATETIME = "//div[@id='newscontent']/p";

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
      if ($node->nodeType == XML_TEXT_NODE && !empty(trim($node->wholeText))) {
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
