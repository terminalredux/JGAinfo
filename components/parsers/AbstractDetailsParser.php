<?php
namespace App\Components\Parsers;

use App\Components\Parsers\Models\SingleNews;
use DomDocument;
use DomXPath;

abstract class AbstractDetailsParser
{
	/**
	 * @const Flags to choose elements to parse
	 */
	const FLAG_AUTHOR = 1;
	const FLAG_MAIN_PHOTO = 2;
	const FLAG_GALLERY = 3;
	const FLAG_UPDATE_DATETIME = 4;

	/**
	 * Required parsers: - parseTitle()
	 *                   - parseContent()
	 *                   - parsePubDateTime()
	 * Optional parsers: - parseAuthor()
	 *                   - parseMainPhoto()
	 *                   - parseGallery()
	 *                   - parseUpdateDateTime()
	 * Template method design pattern
	 * @param string $url to parse
	 * @param array $flags to choose optional elements to parse
   * @return SingleNews
	 */
	public final function parse($url, $flags = []) : SingleNews {
		$this->prepareParser($url);
		$this->parseTitle();
		$this->parseContent();
		$this->parsePubDateTime();

		if (in_array(self::FLAG_AUTHOR, $flags)) {
			$this->parseAuthor();
		}
		if (in_array(self::FLAG_MAIN_PHOTO, $flags)) {
			$this->parseMainPhoto();
		}
		if (in_array(self::FLAG_GALLERY, $flags)) {

		}
		if (in_array(self::FLAG_UPDATE_DATETIME, $flags)) {
			$this->parseUpdateDateTime();
		}
		return $this->getNews();
	}

	/**
	 * Creates xPath, SingleNews & sets sourceLink
	 * @param string $url to parse
	 */
	private function prepareParser($url) : void {
		$this->setXPath($this->getXPath($url));
		$this->setNews(new SingleNews());
		$this->getNews()->setSourceLink($url);
	}

	/**
	 * parse and sets SingleNews title
	 */
	protected abstract function parseTitle() : void;

	/**
	 * parse and sets SingleNews content
	 */
	protected abstract function parseContent() : void;

	/**
	 * parse and sets SingleNews publication date-time
	 */
	protected abstract function parsePubDateTime() : void;

	/**
	 * Getters && Setters
	 */
	protected abstract function getNews() : SingleNews;
	protected abstract function setNews($news) : void;
	protected abstract function setXPath($xPath) : void;

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
	private function getXPath($link) : DomXPath {
		libxml_use_internal_errors(true);
		$dom = new DomDocument;
		$dom->loadHTMLFile($link);
		return new DomXPath($dom);
	}
}
