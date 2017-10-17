<?php
namespace Libs\Base;
use Libs\Base\View;
use Libs\Exceptions\MethodNotFoundException;

class Controller
{
  public function __construct() {
    $this->view = new View();
  }

  /**
   * If action doesn't exists, throws exception
   */
  public function __call($method, $arguments) {
    if (!method_exists($this, $method)) {
      throw new MethodNotFoundException($method);
    }
  }

  /**
   * Check if there is a post
   */
  public function isPost() {
    return !empty($_POST);
  }

  /**
   * Routes to action in different controller
   * For example 'site/index'
   */
  public function executeAction($route) {
    header('Location: ' . URL . $route);
  }
}
