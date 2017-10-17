<?php
namespace App\Components\Parsers;

use App\Components\Parsers\Jelonka\DetailsParserJelonka;
use App\Components\Parsers\Models\SingleNews;

class NewsDetailsFactory
{
  private const SITE_JELONKA = 'jelonka';

  /**
   * Returns object SingleNews from requested site
   * @param string $site
   * @param string $url to parse details
   * @return SingleNews
   */
  public static function create($site, $url) : SingleNews {
    switch ($site) {
      case self::SITE_JELONKA:
        $parser = new DetailsParserJelonka();
        $news = $parser->parse($url);
        break;
      default:
        $news = null; // should throw an error 1!!!!
    }
    return $news;
  }
}
