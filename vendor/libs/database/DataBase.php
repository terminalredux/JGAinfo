<?php
namespace Libs\Database;
require_once "config/db_connection.php";
use PDO;

class DataBase extends PDO
{
  private $host = HOST;
  private $dbname = DBNAME;
  private $user= USER;
  private $password = PASSWORD;

  public function __construct() {
    parent::__construct("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
  }
}
