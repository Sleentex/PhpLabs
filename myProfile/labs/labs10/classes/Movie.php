<?php  
require_once "DbObject.php";
class Movie extends DbObject
{
	private $id;
	private $name;
	private $video;
	private $video_describe;
	private $photo;
	private $author_id;
	const TABLE_NAME='movies';

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
			"video" => $this->getVideo(),
			"video_describe" => $this->getVideoDescribe(),
			"photo" => $this->getPhoto(),
			"author_id" => $this->getAuthor()
		];
	}

	public function arrayToObject($arr) {
		$obj = new Movie();
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

	public function getVideo() {
		return $this->video;
	}

	public function setVideo($video) {
		$this->video = $video;
		return $this;
	}

	public function getVideoDescribe() {
		return $this->video_describe;
	}

	public function setVideoDescribe($video_describe) {
		$this->video_describe = $video_describe;
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

	public function getMoviesForAuthorId($id) {
		$arr = $this->query("SELECT * FROM `movies` WHERE `author_id` = '{$id}'");

		$objects = [];
		while ($row = $arr->fetch_assoc()) {
			$objects[] = $this->arrayToObject($row);
		}
		return $objects;
	}
}
?>