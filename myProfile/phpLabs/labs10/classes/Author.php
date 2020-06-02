<?php  
require_once "DbObject.php";
class Author extends DbObject
{
	private $id;
	private $f_name;
	private $l_name;
	private $surname;
	private $photo;
	const TABLE_NAME='authors';

	public function __construct() {
		parent::connect();
	}

	protected function getTableName() {
		return self::TABLE_NAME;
	}

	public function objectToArray() {
		return $arr = [
			"id" => $this->getId(),
			"f_name" => $this->getFirstName(),
			"l_name" => $this->getLastName(),
			"surname" => $this->getSurname(),
			"photo" => $this->getPhoto()
		];
	}

	public function arrayToObject($arr) {
		$obj = new Author();
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

	public function getFirstName() {
		return $this->f_name;
	}

	public function setFirstName($f_name) {
		$this->f_name = $f_name;
		return $this;
	}

	public function getLastName() {
		return $this->l_name;
	}

	public function setLastName($l_name) {
		$this->l_name = $l_name;
		return $this;
	}

	public function getSurname() {
		return $this->surname;
	}

	public function setSurname($surname) {
		$this->surname = $surname;
		return $this;
	}

	public function getPhoto() {
		return $this->photo;
	}

	public function setPhoto($photo) {
		$this->photo = $photo;
		return $this;
	}

	public function getMaxId() {
		$arr = $this->query("SELECT MAX(id) FROM `authors`");

		$count = $arr->fetch_row();
		return $count[0];
	}

}
?>