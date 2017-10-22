<?php
namespace App\Components\Parsers;

use App\Components\Parsers\{
  Jelonka\DetailsParserJelonka as Jelonka,
  Jg24\DetailsParserJG24 as JG24,
  Jgora24\DetailsParserJgora24 as Jgora24,
  Models\SingleNews
};

class NewsDetailsFactory
{
  private const SITE_JELONKA = 'jelonka';
  private const SITE_JG24 = 'jg24';
  private const SITE_24JGORA = '24jgora';

  /**
   * Returns object SingleNews from requested site
   * @param string $site
   * @param string $url to parse details
   * @return SingleNews
   */
  public static function create($site, $url) : SingleNews {
    switch ($site) {
      case self::SITE_JELONKA:
        $parser = new Jelonka();
        $news = $parser->parse($url, [
          Jelonka::FLAG_AUTHOR,
          Jelonka::FLAG_MAIN_PHOTO,
          Jelonka::FLAG_UPDATE_DATETIME
        ]);
        break;
      case self::SITE_JG24:
        $parser = new JG24();
        $news = $parser->parse($url);
        break;
      case self::SITE_24JGORA:
        $parser = new Jgora24();
        $news = $parser->parse($url, [
          Jgora24::FLAG_AUTHOR,
          Jgora24::FLAG_MAIN_PHOTO
        ]);
        break;
      default:
        $news = null; //TODO should throw an error !!!
    }
    return $news;
  }
}
