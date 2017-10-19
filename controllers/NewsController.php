<?php
namespace App\Controllers;

use Libs\Base\Controller;
use App\Controllers\SiteController;
use App\Controllers\ErrorController;
use App\Components\Parsers\NewsListFactory;
use App\Components\Parsers\NewsDetailsFactory;

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
   * @param string $site key
   */
  public function actionDetails($site) {
    if ($this->isPost()) {
      $this->view->site = $site;
      $this->view->news = NewsDetailsFactory::create($site, $_POST['details_url']);
      if (!is_null($this->view->news)) {
        $this->view->render('news/details');
      } else {
          (new ErrorController)->newsSiteNotFound($site);
      }
    } else {
      header('Location: ' . URL . 'news/list/' . $site);
    }
  }

}
