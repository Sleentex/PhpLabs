<?php 
	require_once "DbObject.php";
	require_once "Teacher.php";
	require_once "Subject.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
		
$teacher = new Teacher();
$oneTeahcer = $teacher->getById(1);
$oneTeahcer->setName("Tes1t");

$teacher->update($oneTeahcer);


/*$teacher->setName("Serj1");
$teacher->insert();*/

$arrTeacher = $teacher->getAll();

foreach($arrTeacher as $value) {
	echo $value->getId()." ".$value->getName()."<br>";
}



$oneTeahcer = $teacher->getById(1);
echo $oneTeahcer->getId()." ".$oneTeahcer->getName()."<br>";
/*foreach($row as $value) {
	echo $value->getId()." ".$value->getName()."<br>";
}*/


$subject = new Subject();
$oneSub = $subject->getById(2);
$oneSub->setName('OldName')->setHour(20)->setFormControl('залік');
$subject->update($oneSub);
/*$oneSubject = $subject->getById(1);
echo $oneSubject->getId()." ".$oneSubject->getName()." ".$oneSubject->getSemester()." ".$oneSubject->getHour()." ".$oneSubject->getFormControl()." ".
		($teacher->getById($oneSubject->getTeacher()))->getName()."<br>";*/


/*$subject->setName("NewName")->setSemester(1)->setHour(140)->setFormControl("іспит")->setTeacher($teacher);
$subject->insert();*/

$arrSub = $subject->getAll();
foreach($arrSub as $value) {
	echo $value->getId()." ".$value->getName()." ".$value->getSemester()." ".$value->getHour()." ".$value->getFormControl()." ".
		($teacher->getById($value->getTeacher()))->getName()."<br>";
}

?>
</body>
</html>