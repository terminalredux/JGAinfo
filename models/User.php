<?php
namespace App\Models;
use Libs\Base\Model;

class User extends Model
{
	private $firstName;
	private $lastName;
	
	public function __construct($firstName, $lastName) {
		$this->firstName = $firstName;
		$this->lastName = $lastName;
	}
	
	public function getFullName() {
		return $this->firstName . ' ' . $this->lastName;
	} 
}