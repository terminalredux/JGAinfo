<?php
namespace App\Controllers;

use Libs\Base\Controller;
use Libs\Session\Session;
use App\Controllers\SiteController;

class DashboardController extends Controller
{
  public function __construct() {
    if (Session::get('logged')) {
      parent::__construct();
    } else {
      $this->executeAction('site/login');
    }
  }

  public function actionIndex() {
    $this->view->render('dashboard/index');
  }
}
