<?php
namespace App\Components\Parsers;

use DomDocument;
use DomXPath;

abstract class AbstractDetailsParser
{
  /**
	 * @param string link to parse
	 * @return DomXPath (xpath)
	 */
	public function getXPath($link) : DomXPath {
		libxml_use_internal_errors(true);
		$dom = new DomDocument;
		$dom->loadHTMLFile($link);
		return new DomXPath($dom);
	}
}
