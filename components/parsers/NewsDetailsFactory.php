<?php
namespace App\Components\Parsers;

use App\Components\Parsers\Jelonka\DetailsParserJelonka;

class NewsDetailsFactory
{
  private const SITE_JELONKA = 'jelonka';

  /**
   * Returns object SingleNews from requested site
   * @param string $site
   * @return array
   */
  public static function create($site) : string {
    switch ($site) {
      case self::SITE_JELONKA:
        $parser = new DetailsParserJelonka();
        $news = $parser->parse();
        break;
      default:
        $news = [];
    }
    return $news;
  }
}
