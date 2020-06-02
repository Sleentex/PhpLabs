<?php require_once "../connect/connect.php"; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Lab5 DB</title>
	<link rel="stylesheet" href="../lab4/assets/css/style.css?v=7">
</head>
<body>
	<h2>Інформація про навчальні предмети</h2>
	<table  border="2" cellspacing="2" >
		<form method='POST' action='http://localhost/myProfile/phpLabs/lab5/send.php'>
			<tr>
				<th>Предмет</th>
				<th>Семестр</th>
				<th>Години</th>
				<th>Форма контролю</th>
				<th>Лектор</th>
			</tr>
			
			<?php 
				$query = "SELECT * FROM data ORDER BY semester DESC, subject";
				if($result = $mysqli->query($query)) : ?> 
					<?php while ($row = $result->fetch_assoc()) : ?>
						<tr>
							<td><?= $row['subject'] ?></td>
							<td><?= $row['semester'] ?></td>
							<td><?= $row['hour'] ?></td>
							<td><?= $row['form_control'] ?></td>
							<td><?= $row['full_name_lecturer'] ?></td>
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
				<td><input type='text' name='pib' placeholder='Введіть ПІБ' pattern="^^[А-Яа-яІі\s\.]+$" required></td>
			</tr>

			<tr>
				<td colspan="5"><input type="submit" name="submit" id="submit" value="Добавити"></td>
			</tr>		
		</form>	 
	</table>

	<?php  
		if($result = $mysqli->query($query = "SELECT COUNT(DISTINCT full_name_lecturer) FROM data")) {
			$row = $result->fetch_row();
			echo "<p align='center'>Усього лекторів: $row[0]</p>";
			$result->close();
		} else {
			$message = "Неверный запрос: " . $mysqli->error . "</br>";
			$message .= "Запрос целиком: " . $query;
			die($message);
		}
	?>		

	<h2>ПОШУК</h2>
	<table border="2">
		<form method="POST" action="http://localhost/myProfile/phpLabs/lab5/index.php">
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
				<td><input type="search" placeholder="Введіть ПІБ" pattern="^[А-Яа-яІі\s\.]+$" name="4"></td>
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
							 		$line[] = "full_name_lecturer LIKE '%" . $_POST[$i] . "%'";
							 		$checkPost = true;
							 		break;	
							} 							
						}
					}
					$where = implode(' AND ', $line);
				}
			?>

			<?php if($checkPost) : 
				$query = "SELECT * FROM data WHERE " . $where . " ORDER BY semester DESC, subject";
			?>

				<?php if($result = $mysqli->query($query)) : ?>
					<?php while ($row = $result->fetch_assoc()) : ?>
						<tr>
							<td><?= $row['subject'] ?></td>
							<td><?= $row['semester'] ?></td>
							<td><?= $row['hour'] ?></td>
							<td><?= $row['form_control'] ?></td>
							<td><?= $row['full_name_lecturer'] ?></td>
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