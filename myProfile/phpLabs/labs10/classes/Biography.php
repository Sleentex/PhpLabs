<?php  
require_once "DbObject.php";
class Biography extends DbObject
{
	private $id;
	private $text;
	private $author_id;
	const TABLE_NAME='biography';

	public function __construct() {
		parent::connect();
	}

	protected function getTableName() {
		return self::TABLE_NAME;
	}

	public function objectToArray() {
		return $arr = [
			"id" => $this->getId(),
			"text" => $this->getText(),
			"author_id" => $this->getAuthor()
		];
	}

	public function arrayToObject($arr) {
		$obj = new Biography();
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

	public function getBiographysForAuthorId($id) {
		$arr = $this->query("SELECT * FROM `biography` WHERE `author_id` = '{$id}'");

		$objects = [];
		while ($row = $arr->fetch_assoc()) {
			$objects[] = $this->arrayToObject($row);
		}
		return $objects;
	}

	public function countBiographyForAuthorId($id) {
		$arr = $this->query("SELECT COUNT(id) FROM `biography` WHERE `author_id` = '{$id}'");

		$count = $arr->fetch_row();
		return $count[0];
	}

	public function getMaxId() {
		$arr = $this->query("SELECT MAX(id) FROM `biography`");

		$count = $arr->fetch_row();
		return $count[0];
	}
}
?>