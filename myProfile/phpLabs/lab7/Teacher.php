<?php  
require_once "DbObject.php";
class Teacher extends DbObject
{
	private $id;
	private $name;
	const TABLE_NAME='teachers1';

	public function __construct() {
		parent::connect();
	}

	protected function getTableName() {
		return self::TABLE_NAME;
	}

	public function objectToArray() {
		return $arr = [
			"id" => $this->getId(),
			"name" => $this->getName()
		];
	}

	public function arrayToObject($arr) {
		$obj = new Teacher();
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

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	public function vasyaProst() {
		/*$this->*/
	}
}
?>