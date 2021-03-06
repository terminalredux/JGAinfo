<?php
namespace Libs\Base;

use Libs\Base\ControllerFactory;
use Libs\Exceptions\MethodNotFoundException;
use Libs\Session\Session;
use App\Controllers\ErrorController;

/**
 * Singleton class
 */
class Bootstrap
{
  private static $instance = false;

  /**
   * Singleton design pattern
   * @return Bootstrap object
   */
  public static function getInstance() : self {
    if (self::$instance == false) {
      self::$instance = new Bootstrap();
    }
    return self::$instance;
  }

  private function __construct() {}

  public function initTemplate() {
    require_once "views/template/main.php";
  }

  public function sessionInit() {
    Session::init();
  }

  public function getContent() {
    $url = $this->getUrl();
    $file = 'controllers/' . $url[0] . 'Controller.php';

    if (file_exists($file) && $file != 'controllers/errorController.php') {
      $controller = ControllerFactory::create($url[0]);
      $this->executeAction($url, $controller);
    } else {
      (new ErrorController)->pageNotFound("<strong style='font-size: 1.2em'>" . $url[0] . "Controller</strong> doesn't exists!");
      return false;
    }
  }

  /**
   * @return array $url
   */
  private function getUrl() : array {
    if(!isset($_GET['url'])) {
      $url[0] = DEFAULT_CONTROLLER;
      $url[1] = DEFAULT_ACTION;
    } else {
      $url = $_GET['url'];
      $url = rtrim($url, '/');
    	$url = explode('/',$_GET['url']);
    }
    return $url;
  }

  /**
   * @param array $url
   * @param Controller $controller
   * @return void
   */
  private function executeAction($url, $controller) {
    try {
      if (!isset($url[1])) {
        $controller->{DEFAULT_ACTION_INDEX}();  // sets default action to index
      } else if (isset($url[2])) {              // if user provides arguments for action
        $controller->{'action' . $url[1]}($url[2]);
      } else if (isset($url[1])) {
        if (empty($url[1])) {
          $url[1] = DEFAULT_CONTROLLERS_ACTION; // if user provide only "domain/controller/"
        }
        $controller->{'action' . $url[1]}();
      }
    } catch (MethodNotFoundException $e) {
        (new ErrorController)->pageNotFound("<strong style='font-size: 1.2em'>action" . $url[1] . "</strong> doesn't exists!");
        //alternative: $e->getMessage();
    }
  }

}
