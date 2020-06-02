<?php require_once "../connect/connect.php"; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Lab6 DB</title>
	<link rel="stylesheet" href="../lab4/assets/css/style.css?v=1">
</head>
<body>
	<h2>Інформація про навчальні предмети</h2>
	<table  border="1" cellspacing="2" >
		<form method='POST' action='http://localhost/myProfile/phpLabs/lab6/send.php'>
			<tr>
				<th>Предмет</th>
				<th>Семестр</th>
				<th>Години</th>
				<th>Форма контролю</th>
				<th>Лектор</th>
			</tr>
			
			<?php 
				$query = "SELECT subject, semester, hour, form_control, name FROM exams e, teachers t WHERE e.teacher_id = t.id ORDER BY semester DESC, subject";
				if($result = $mysqli->query($query)) : ?> 
					<?php while ($row = $result->fetch_assoc()) : ?>
						<tr>
							<td><?= $row['subject'] ?></td>
							<td><?= $row['semester'] ?></td>
							<td><?= $row['hour'] ?></td>
							<td><?= $row['form_control'] ?></td>
							<td><?= $row['name'] ?></td>
						</tr>
					<?php endwhile; ?>
					<?php $result->close(); ?>
			<?php  
				else: {
				    $message  = 'Неверный запрос: ' . $mysqli->error . "</br>";
				    $message .= 'Запрос целиком: ' . $query;
				    die($message);
				}
				endif;
			?>

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
						<?php if($result = $mysqli->query("SELECT * FROM teachers")) : ?>
							<?php while($row = $result->fetch_assoc()) : ?>
								<option value=<?= $row["id"] ?>><?= $row["name"] ?></option>
							<?php endwhile; ?>
						<?php endif; ?>
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
			<form method="POST" action="http://localhost/myProfile/phpLabs/lab6/index.php">
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
		if($result = $mysqli->query($query = "SELECT COUNT(DISTINCT teacher_id) FROM exams")) {
			$row = $result->fetch_row();
			echo "<p align='center'> Усього лекторів: $row[0] </p>";
			$result->close();
		} else {
			$message = "Неверный запрос: " . $mysqli->error . "</br>";
			$message .= "Запрос целиком: " . $query;
			die($message);
		}
	?>	

	<?php 
		if(isset($_POST['addLector'])) {
			if($result = $mysqli->query("INSERT INTO teachers VALUES(NULL, '" . $_POST['teacherName'] . "')"));
			else {
				$message = "Неверный запрос: " . $mysqli->error . "</br>";
				//$message .= "Запрос целиком: " . $query;
				//pattern="^[А-Яа-яІі\s\.]+$"
				die($message);
			}
			header("Location: http://localhost/myProfile/phpLabs/lab6");
		}
	?>

	<h2>ПОШУК</h2>
	<table border="2">
		<form method="POST" action="http://localhost/myProfile/phpLabs/lab6/index.php">
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
						<?php if($result = $mysqli->query("SELECT * FROM teachers")) : ?>
							<?php while($row = $result->fetch_assoc()) : ?>
								<option value=<?= $row["id"] ?>><?= $row["name"] ?></option>
							<?php endwhile; ?>
						<?php endif; ?>
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
							 		$line[] = "subject LIKE '%" . $_POST[$i] . "%'";
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

			<?php if($checkPost) : 
				$query = "SELECT * FROM exams e, teachers t WHERE e.teacher_id = t.id AND " . $where . " ORDER BY semester DESC, subject";
			?>

				<?php if($result = $mysqli->query($query)) : ?>
					<?php while ($row = $result->fetch_assoc()) : ?>
						<tr>
							<td><?= $row['subject'] ?></td>
							<td><?= $row['semester'] ?></td>
							<td><?= $row['hour'] ?></td>
							<td><?= $row['form_control'] ?></td>
							<td><?= $row['name'] ?></td>
						</tr>
					<?php endwhile; ?>
					<?php $result->close(); ?>
				<?php else: {
					    $message  = 'Неверный запрос: ' . $mysqli->error . "</br>";
					    $message .= 'Запрос целиком: ' . $query;
					    die($message);
					}
					endif; 
				?>
			<?php endif; ?>
		</form>
	</table>	 	
</body>
</html>

<?php mysqli_close($mysqli); ?>