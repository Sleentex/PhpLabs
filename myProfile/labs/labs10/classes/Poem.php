<?php  
require_once "DbObject.php";
class Poem extends DbObject
{
	private $id;
	private $name;
	private $text;
	private $author_id;
	const TABLE_NAME='poems';

	public function __construct() {
		parent::connect();
	}

	protected function getTableName() {
		return self::TABLE_NAME;
	}

	public function objectToArray() {
		return $arr = [
			"id" => $this->getId(),
			"name" => $this->getName(),
			"text" => $this->getText(),
			"author_id" => $this->getAuthor()
		];
	}

	public function arrayToObject($arr) {
		$obj = new Poem();
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

	public function getText() {
		return $this->text;
	}

	public function setText($text) {
		$this->text = $text;
		return $this;
	}

	public function getAuthor() {
		return $this->author_id;
	}

	public function setAuthor(Author $author) {
		$this->author_id = $author->getId();
		return $this;
	}

	public function setAuthorId($author_id) {
		$this->author_id = $author_id;
		return $this;
	}

	public function getPoemsForAuthorId($id) {
		$arr = $this->query("SELECT * FROM `poems` WHERE `author_id` = '{$id}'");

		$objects = [];
		while ($row = $arr->fetch_assoc()) {
			$objects[] = $this->arrayToObject($row);
		}
		return $objects;
	}
}
?>