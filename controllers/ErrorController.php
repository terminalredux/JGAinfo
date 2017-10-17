<?php
namespace App\Controllers;
use Libs\Base\Controller;

class ErrorController extends Controller
{
  public function __construct() {
    parent::__construct();
  }

  public function pageNotFound($errorMessage) {
    $this->view->errorMessage = $errorMessage;
    $this->view->render('error/page_not_found');
  }

  public function newsSiteNotFound($site) {
    $this->view->site = $site;
    $this->view->render('error/news_site_not_found');
  }

}
