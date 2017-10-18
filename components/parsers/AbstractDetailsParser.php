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
	 * @param array $flags to choose elements to parse
   * @return SingleNews
	 */
	public final function parse($url, $flags = []) : SingleNews {
		$this->prepareParser($url);
		$this->parseTitle();
		$this->parseContent();
		$this->parsePubDateTime();

		if (in_array(self::FLAG_AUTHOR, $flags)) {
			$this->parseAuthor();
		} else if (in_array(self::FLAG_MAIN_PHOTO, $flags)) {

		} else if (in_array(self::FLAG_GALLERY, $flags)) {

		} else if (in_array(self::FLAG_UPDATE_DATETIME, $flags)) {

		}
		return $this->getNews();
	}

	/**
	 * @param string $url to parse
	 */
	private function prepareParser($url) : void {
		$this->setXPath($this->getXPath($url));
		$this->setNews(new SingleNews());
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
	 * parse and sets SingleNews author
	 */
	protected abstract function parseAuthor() : void;

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
