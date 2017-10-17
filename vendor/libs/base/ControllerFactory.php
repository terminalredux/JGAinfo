<?php
namespace Libs\Base;

use Libs\Base\Controller;
use App\Controllers\SiteController;
use App\Controllers\AboutController;
use App\Controllers\DashboardController;
use App\Controllers\NewsController;

class ControllerFactory
{
  /**
   * @param string $controllerAlias
   * @return Controller Object
   */
  public static function create($controllerAlias) : Controller {
    $controllerAlias = strtolower($controllerAlias);
    if ($controllerAlias == "site") {
      $controller = new SiteController;
    } else if ($controllerAlias == "about") {
      $controller = new AboutController;
    } else if ($controllerAlias == "dashboard") {
      $controller = new DashboardController;
    } else if ($controllerAlias == "news") {
      $controller = new NewsController;
    }
    return $controller;
  }
}
