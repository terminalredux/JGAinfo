<?php
namespace App\Components\Parsers;

use App\Components\Parsers\Models\NewsList; //No connection with NewsListFactory
use DomDocument;
use DomXPath;

abstract class AbstractListParser
{
  /**
   * Parses list of news
   * Template method - design pattern
   * @return array
   */
  public final function parse() : array {
    $newsList = $this->getNewsList($this->url, $this->xPaths);
    return $this->generateList($newsList);
  }

  /**
   * Assigns individual lists (e.g. titles, links) elements to objects
   * (NewsListItem) which represent single news in the news list
   * @param NewsList $newsList
   * @return array of NewsListItem objects
   */
  protected abstract function generateList($newsList) : array;

  /**
   * Change string publication data-time to timestamp
   * @param string $datetime
   * @return int
   */
  protected abstract function preparePubDateTime($datetime) : int;

  /**
   * Gets individual lists (linke a titles, thumbnails ...)
   * @param string $url
   * @param array $xPaths
   * @return NewsList
   */
  private function getNewsList($url, $xPaths) : NewsList {
    $xpath = $this->getXPath($url);
    $newsList = new NewsList();
      $newsList->setTitles($xpath->query($xPaths['XPATH_TITLES']));
      $newsList->setShortContents($xpath->query($xPaths['XPATH_SHORTCONTENTS']));
      $newsList->setAuthors($xpath->query($xPaths['XPATH_AUTHORS']));
      $newsList->setThumbnails($xpath->query($xPaths['XPATH_THUMBNAILS']));
      $newsList->setLinks($xpath->query($xPaths['XPATH_LINKS']));
      $newsList->setPubDateTimes($xpath->query($xPaths['XPATH_PUBDATETIMES']));
    return $newsList;
  }

  /**
	 * @param string link to parse
	 * @return DomXPath (xpath)
	 */
	private function getXPath($link) : DomXPath {
		libxml_use_internal_errors(true);
		$dom = new DomDocument;
		$dom->loadHTMLFile($link);
		return new DomXPath($dom);
	}
}
