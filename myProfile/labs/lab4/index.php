<?php 
	$file = fopen('assets/documents/doc.txt', 'r+');
	if(!$file) {
		die("Couldn`t open file!");
	} 	
 ?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Lab4 Search</title>
	<link rel="stylesheet" href="assets/css/style.css?v=6">
</head>
<body>
	<h2>Інформація про навчальні предмети</h2>
	<table  border="2" cellspacing="2" >
		<form method='POST' action='http://localhost/myProfile/phpLabs/lab4/send.php'>
			<tr>
				<th>Предмет</th>
				<th>Семестр</th>
				<th>Години</th>
				<th>Форма контролю</th>
				<th>Лектор</th>
			</tr>

			<?php
				$twoArr = [];
				while(!feof($file)) {
			  		$str = fgets($file);
			  		$arr = explode(";", $str);  
			  		array_pop($arr);	
			  		array_push($twoArr, $arr);
			  	}

			  	usort($twoArr, function ($a, $b) {
			  		return $b[1] - $a[1];
			  	});		  	
			?>	
			  	<?php foreach ($twoArr as $value) : ?>
			  		<tr>
			  		<?php foreach ($value as $v) : ?>
			  			<td><?=$v?></td>
			  		<?php endforeach; ?>
			  		</tr>
			  	<?php endforeach; ?>

			<tr>
				<td><input type='text' name='name' placeholder='Введіть предмет' pattern="^[А-Яа-яІі\s]+$" required></td>
				<td><input type='number' name='semester' placeholder='Введіть номер' min="1" required></td>
				<td><input type='number' name='hour' placeholder='Введіть годину' min="1" required></td>
				<td><input type='text' name='formControl' placeholder='Введіть контроль' pattern="^[А-Яа-яІі\s]+$" required></td>
				<td><input type='text' name='pib' placeholder='Введіть ПІБ' pattern="^^[А-Яа-яІі\s]+$" required></td>
			</tr>

			<tr>
				<td colspan="5"><input type="submit" name="submit" id="submit" value="Добавити"></td>
			</tr>					
		</form>	 
	</table>

	<h2>ПОШУК</h2>
	<table border="2">
		<form method="POST" action="http://localhost/myProfile/phpLabs/lab4/index.php">
			<tr>
				<td><input type="search" placeholder="Введіть предмет" pattern="^[А-Яа-яІі\s]+$" name="0"></td>
				<td><input type="search" placeholder="Введіть номер" pattern="^[ 0-9]+$" name="1"></td>
				<td><input type="search" placeholder="Введіть годину" pattern="^[ 0-9]+$" name="2"></td>
				<td><input type="search" placeholder="Введіть контроль" pattern="^[А-Яа-яІі\s]+$" name="3"></td>
				<td><input type="search" placeholder="Введіть ПІБ" pattern="^[А-Яа-яІі\s]+$" name="4"></td>
			</tr>
			<tr>
				<td colspan="5"><input type="submit" name="submitCheck" value="Пошук предмета"></td>
			</tr>

			<?php 
				$checkPost = false;

				if (isset($_POST['submitCheck'])) {
					for ($i = 0; $i < 5; $i++) {
						if (isset($_POST[$i]) && $_POST[$i] != '') {
							$line[$i] = $_POST[$i];
							$checkPost = true;
						}
					}
				}
			?>

			<?php if ($checkPost) : ?> 
				<?php foreach ($twoArr as $arr) : ?> 
					<?php foreach ($line as $key => $value) : ?>
						<?php if (mb_stristr($arr[$key], $value) === false) break; ?>
						<?php if ($value == end($line)) : ?>
							<tr>
				  			<?php foreach ($arr as $v) : ?>
				  				<td><?=$v?></td>
				  			<?php endforeach; ?>
				  			</tr>
						<?php endif; ?> 
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endif; ?>  

		</form>
	</table>
</body>
</html>

