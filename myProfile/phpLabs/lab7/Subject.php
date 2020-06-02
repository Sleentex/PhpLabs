<?php  
require_once "DbObject.php";
class Subject extends DbObject
{
	private $id;
	private $name;
	private $semester;
	private $hour;
	private $form_control;
	private $teacher_id;
	const TABLE_NAME='exams1';

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
			"semester" => $this->getSemester(),
			"hour" => $this->getHour(),
			"form_control" => $this->getFormControl(),
			"teacher_id" => $this->getTeacher()
		];
	}

	public function arrayToObject($arr) {
		$obj = new Subject();
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

	public function getSemester() {
		return $this->semester;
	}

	public function setSemester($semester) {
		$this->semester = $semester;
		return $this;
	}

	public function getHour() {
		return $this->hour;
	}

	public function setHour($hour) {
		$this->hour = $hour;
		return $this;
	}

	public function getFormControl() {
		return $this->form_control;
	}

	public function setFormControl($form_control) {
		$this->form_control = $form_control;
		return $this;
	}

	public function getTeacher() {
		return $this->teacher_id;
	}

	public function setTeacher(Teacher $teacher) {
		$this->teacher_id = $teacher->getId();
		return $this;
	}

	public function setTeacherId($teacher_id) {
		$this->teacher_id = $teacher_id;
		return $this;
	}

	public function getSearch($str) {
		$query = "SELECT e.* FROM exams1 e, teachers1 t WHERE e.teacher_id = t.id AND " . $str . " ORDER BY semester DESC, e.name";

		$arr = $this->query($query);
    	$objects = [];
    	while($row = $arr->fetch_assoc()) {
    		$objects[] = $this->arrayToObject($row);
    	}
    	return $objects;
	}

	public function getTeacherCount() {
		$arr = $this->query("SELECT COUNT(DISTINCT teacher_id) FROM exams1");
		$count = $arr->fetch_row();
		return $count[0];
	}
}
?>