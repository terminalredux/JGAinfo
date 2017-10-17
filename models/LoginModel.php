<?php
namespace App\Models;
use Libs\Base\Model;
use PDO;

class LoginModel extends Model
{
  private $email;
  private $password;
  private $passwordHash;

  public function __construct() {
      parent::__construct();
  }

  /**
   * @return bool
   */
  public function login() : bool {
    $this->email = $_POST['email'];
    $sth = $this->db->prepare("SELECT id, password FROM user WHERE email = :email");
    $sth->execute([
      ':email' => $this->email
    ]);

    $data = $sth->fetchAll();

    if (count($data) == 1) {
      $this->password = $_POST['password'];
      $this->passwordHash = $data[0]['password'];
      if (password_verify($this->password, $this->passwordHash)) {
        return true;
      }
    }
    return false;
  }

}
