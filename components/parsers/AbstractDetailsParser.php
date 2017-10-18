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
	public abstract function parse($url) : SingleNews;

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
