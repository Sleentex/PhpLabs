<?php 
	require_once "DbObject.php";
	require_once "Teacher.php";
	require_once "Subject.php";

	$subject = new Subject();
	$teacher = new Teacher();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Lab7 Class</title>
	<link rel="stylesheet" href="../lab4/assets/css/style.css?v=1">
</head>
<body>
	<h2>Інформація про навчальні предмети</h2>
	<table  border="1" cellspacing="2" >
		<form method='POST' action='send.php'>
			<tr>
				<th>Предмет</th>
				<th>Семестр</th>
				<th>Години</th>
				<th>Форма контролю</th>
				<th>Лектор</th>
			</tr>
			
			<?php 

				$subjects = $subject->getAll();
				foreach($subjects as $value) : ?>
						<tr>
							<td><?= $value->getName() ?></td>
							<td><?= $value->getSemester() ?></td>
							<td><?= $value->getHour() ?></td>
							<td><?= $value->getFormControl() ?></td>
							<td><?= ($teacher->getById($value->getTeacher()))->getName() ?></td>
						</tr>
			<?php endforeach; ?>
		 

			<tr>
				<td><input type='text' name='name' placeholder='Введіть предмет' required></td>
				<td><input type='number' name='semester' placeholder='Введіть номер' min="1" max="16" required></td>
				<td><input type='number' name='hour' placeholder='Введіть годину' min="1" required></td>
				<td>
					<select name='formControl' required>
						<option value="" selected hidden>Виберіть контроль</option>
						<option value="іспит">іспит</option>
						<option value="залік">залік</option>
					</select>
				</td>
				<td>
					<select name="pib" required>
						<option value="" selected hidden>Виберіть лектора</option>
							<?php $teachers = $teacher->getAll(); ?>
							<?php foreach($teachers as $value) : ?>
								<option value=<?= $value->getId() ?>><?= $value->getName() ?></option>
							<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<input class="inputSubmit" type="submit" name="submit" id="submit" value="Добавити предмет">
				</td>					
			</tr>
		</form>
	</table>	

	<h2>Добавити нового лектора</h2>
	<div class="addLectorTable">
		<table>
			<form method="POST" action="index.php">
				<tr>
					<td colspan="2">
						<input type="text" name="teacherName" placeholder="Прізвище І.П." pattern="[А-Я-І][а-я-і]{2,}\s[А-Я-І]{1}\.[А-Я-І]{1}\." required>
					</td>
					<td><input class="inputSubmit" type="submit" name="addLector" value="Добавити"></td>
				</tr>
			</form>
		</table>
	</div>

	<?php 
		if(isset($_POST['addLector'])) {
			$teacher->setName($_POST['teacherName']);
			$teacher->insert();
			header("Location: index.php");
		}
	?>

	<?php  
		echo "<p align='center'> Усього лекторів: {$subject->getTeacherCount()} </p>";
	?>	

	

	<h2>ПОШУК</h2>
	<table border="2">
		<form method="POST" action="index.php">
			<tr>
				<td><input type="search" placeholder="Введіть предмет" name="0"></td>
				<td><input type="search" placeholder="Введіть номер" pattern="^[ 0-9]+$" name="1"></td>
				<td><input type="search" placeholder="Введіть годину" pattern="^[ 0-9]+$" name="2"></td>
				<td>
					<select name="3">
						<option value="" selected>Виберіть контроль</option>
						<option value="іспит">іспит</option>
						<option value="залік">залік</option>
					</select>
				</td>
				<td>
					<select name="4">
						<option value="" selected>Виберіть ПІБ</option>
						<?php $teachers = $teacher->getAll(); ?>
						<?php foreach($teachers as $value) : ?>
							<option value=<?= $value->getId() ?>><?= $value->getName() ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
				
			<tr>
				<td colspan="5"><input type="submit" name="submitCheck" value="Пошук предмета"></td>
			</tr>

			<?php 
				$checkPost = false;
				$line = [];

				if (isset($_POST['submitCheck'])) {
					for ($i = 0; $i < 5; $i++) {
						if (isset($_POST[$i]) && $_POST[$i] != '') {
							switch ($i) {
							 	case 0:
							 		$line[] = "name LIKE '%" . $_POST[$i] . "%'";
							 		$checkPost = true;
							 		break;
							 	case 1:
							 		$line[] = "semester LIKE '%" . $_POST[$i] . "%'";
							 		$checkPost = true;
							 		break;
							 	case 2:
							 		$line[] = "hour LIKE '%" . $_POST[$i] . "%'";
							 		$checkPost = true;
							 		break;
							 	case 3:
							 		$line[] = "form_control LIKE '%" . $_POST[$i] . "%'";
							 		$checkPost = true;
							 		break;
							 	case 4:
							 		$line[] = "teacher_id = " . $_POST[$i] . " ";
							 		$checkPost = true;
							 		break;	
							} 							
						}
					}
					$where = implode(' AND ', $line);
				}
			?>

			<?php if($checkPost) : $subjects = $subject->getSearch($where); ?>
				<?php foreach($subjects as $value) : ?>
						<tr>
							<td><?= $value->getName() ?></td>
							<td><?= $value->getSemester() ?></td>
							<td><?= $value->getHour() ?></td>
							<td><?= $value->getFormControl() ?></td>
							<td><?= $teacher->getById($value->getTeacher())->getName() ?></td>
						</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</form>
	</table>	 	
</body>
</html>
