<?php
namespace App\Controllers;
use Libs\Base\Controller;

class AboutController extends Controller
{
  public function __construct() {
    parent::__construct();
  }

  public function actionIndex() {
    $this->view->render('about/index');
  }
}
