<?php
namespace App\Components\Parsers;

use App\Components\Parsers\Jelonka\ListParserJelonka;
use App\Components\Parsers\Jg24\ListParserJG24;
use App\Components\Parsers\Jgora24\ListParserJgora24;

class NewsListFactory
{
  private const SITE_JELONKA = 'jelonka';
  private const SITE_JG24 = 'jg24';
  private const SITE_24JGORA = '24jgora';

  /**
   * Returns list of news from requested site
   * @param string $site
   * @return array
   */
  public static function create($site) : array {
    switch ($site) {
      case self::SITE_JELONKA:
        $parser = new ListParserJelonka();
        $list = $parser->parse();
        break;
      case self::SITE_JG24:
        $parser = new ListParserJG24();
        $list = $parser->parse();
        break;
      case self::SITE_24JGORA:
        $parser = new ListParserJgora24();
        $list = $parser->parse();
        break;
      default:
        $list = [];
    }
    return $list;
  }

}
