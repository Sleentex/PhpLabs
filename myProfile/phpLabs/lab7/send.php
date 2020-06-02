<?php  
	require_once "Subject.php";
	if(isset($_POST['submit'])) {
		$subject = new Subject();
		$subject->setName($_POST['name'])
				->setSemester($_POST['semester'])
				->setHour($_POST['hour'])
				->setFormControl($_POST['formControl'])
				->setTeacherId($_POST['pib']);

		$subject->insert();
	}
	header("Location: index.php");
?>