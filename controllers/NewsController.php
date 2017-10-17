<?php
namespace App\Controllers;

use Libs\Base\Controller;
use App\Controllers\SiteController;
use App\Controllers\ErrorController;
use App\Components\Parsers\NewsListFactory;

class NewsController extends Controller
{
  public function __construct() {
      parent::__construct();
  }

  public function actionIndex() {
    $this->view->render('news/index');
  }

  /**
   * @param string $site
   */
  public function actionList($site) {
    $this->view->site = $site;
    $this->view->list = NewsListFactory::create($site);

    if (!empty($this->view->list)) {
      $this->view->render('news/list');
    } else {
        (new ErrorController)->newsSiteNotFound($site);
    }
  }

  /**
   * @param string $site
   */
  public function actionDetails($site) {
    if ($this->isPost()) {
      $this->view->site = $site;
      // $_POST['details_url'];
      $this->view->render('news/details');
    }
  }

}
