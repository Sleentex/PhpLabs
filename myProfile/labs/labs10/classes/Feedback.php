<?php  
require_once "DbObject.php";
class Feedback extends DbObject
{
	private $id;
	private $feedback;
	private $user_id;
	private $movie_id;
	const TABLE_NAME='feedbacks';

	public function __construct() {
		parent::connect();
	}

	protected function getTableName() {
		return self::TABLE_NAME;
	}

	public function objectToArray() {
		return $arr = [
			"id" => $this->getId(),
			"feedback" => $this->getFeedback(),
			"user_id" => $this->getUser(),
			"movie_id" => $this->getMovie()
		];
	}

	public function arrayToObject($arr) {
		$obj = new Feedback();
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

	public function getFeedback() {
		return $this->feedback;
	}

	public function setFeedback($feedback) {
		$this->feedback = $feedback;
		return $this;
	}

	public function getUser() {
		return $this->user_id;
	}

	public function setUser(User $user) {
		$this->user_id = $user->getId();
		return $this;
	}

	public function setUserId($user_id) {
		$this->user_id = $user_id;
		return $this;
	}


	public function getMovie() {
		return $this->movie_id;
	}

	public function setMovie(Movie $movie) {
		$this->movie_id = $movie->getId();
		return $this;
	}

	public function setMovieId($movie_id) {
		$this->movie_id = $movie_id;
		return $this;
	}

	public function getFeedbacksForMovieId($id) {
		$arr = $this->query("SELECT * FROM `feedbacks` WHERE `movie_id` = '{$id}'");

		$objects = [];
		while ($row = $arr->fetch_assoc()) {
			$objects[] = $this->arrayToObject($row);
		}
		return $objects;
	}

}
?>