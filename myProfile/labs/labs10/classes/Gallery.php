<?php  
require_once "DbObject.php";
class Gallery extends DbObject
{
	private $id;
	private $photo;
	private $author_id;
	const TABLE_NAME='gallery';

	public function __construct() {
		parent::connect();
	}

	protected function getTableName() {
		return self::TABLE_NAME;
	}

	public function objectToArray() {
		return $arr = [
			"id" => $this->getId(),
			"photo" => $this->getPhoto(),
			"author_id" => $this->getAuthor()
		];
	}

	public function arrayToObject($arr) {
		$obj = new Gallery();
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

	public function getPhoto() {
		return $this->photo;
	}

	public function setPhoto($photo) {
		$this->photo = $photo;
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

	public function getGallerysForAuthorId($id) {
		$arr = $this->query("SELECT * FROM `gallery` WHERE `author_id` = '{$id}'");

		$objects = [];
		while ($row = $arr->fetch_assoc()) {
			$objects[] = $this->arrayToObject($row);
		}
		return $objects;
	}

	public function getMaxId() {
		$arr = $this->query("SELECT MAX(id) FROM `gallery`");

		$count = $arr->fetch_row();
		return $count[0];
	}
}
?>