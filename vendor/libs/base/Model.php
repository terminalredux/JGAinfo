<?php
namespace Libs\Base;
use Libs\Database\DataBase;

class Model
{
  public function __construct() {
    $this->db = new DataBase();
  }
}
