<?php  
require_once "DbObject.php";
class Admin extends DbObject
{
	private $id;
	private $login;
	private $pass;
	private $name;
	const TABLE_NAME='admins';

	public function __construct() {
		parent::connect();
	}

	protected function getTableName() {
		return self::TABLE_NAME;
	}

	public function objectToArray() {
		return $arr = [
			"id" => $this->getId(),
			"login" => $this->getLogin(),
			"pass" => $this->getPass(),
			"name" => $this->getName()
		];
	}

	public function arrayToObject($arr) {
		$obj = new Admin();
        foreach ($arr as $key => $value) {
            $obj->{$key} = $value;
        }
        return $obj;
	}

   	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function getLogin() {
		return $this->login;
	}

	public function setLogin($login) {
		$this->login = $login;
		return $this;
	}

	public function getPass() {
		return $this->pass;
	}

	public function setPass($pass) {
		$this->pass = $pass;
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	public function getAuthorization() {
		$arr = $this->query("SELECT * FROM `admins` WHERE `login` = '{$this->getLogin()}' AND `pass` = '{$this->getPass()}'");

		$objects = [];
		while ($row = $arr->fetch_assoc()) {
			$objects[] = $this->arrayToObject($row);
		}
		return $objects;
	}

	public function checkLoginUnique() {
		$arr = $this->query("SELECT * FROM `admins` WHERE `login` = '{$this->getLogin()}'");

		$objects = [];
		while ($row = $arr->fetch_assoc()) {
			$objects[] = $this->arrayToObject($row);
		}
		return $objects;
	}
}
?>