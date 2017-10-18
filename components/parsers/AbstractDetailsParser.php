<?php
namespace App\Components\Parsers;

use App\Components\Parsers\Models\SingleNews;
use DomDocument;
use DomXPath;

abstract class AbstractDetailsParser
{
	/**
	 * @param string $url to parse
   * @return SingleNews
	 */
	public function parse($url) : SingleNews {
		$this->initParser($url);
		$this->parseTitle();
		$this->parseContent();
		$this->parsePubDateTime();
		$this->parseAuthor();
		return $this->getNews();
	}

	private function initParser($url) {
		$this->setXPath($this->getXPath($url));
		$this->setNews(new SingleNews());
	}
	protected abstract function parseTitle();
	protected abstract function parseContent();
	protected abstract function parsePubDateTime();
	protected abstract function parseAuthor();
	protected abstract function getNews();
	protected abstract function setNews($news);
	protected abstract function setXPath($xPath);


	/**
   * Change string publication data-time to timestamp
   * @param string $datetime
   * @return int
   */
	protected abstract function preparePubDateTime($datetime) : int;

  /**
	 * @param string link to parse
	 * @return DomXPath (xpath)
	 */
	protected function getXPath($link) : DomXPath {
		libxml_use_internal_errors(true);
		$dom = new DomDocument;
		$dom->loadHTMLFile($link);
		return new DomXPath($dom);
	}
}
