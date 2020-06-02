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
	<title>Lab3 Array</title>
	<link rel="stylesheet" href="assets/css/css.css?v=8">
</head>
<body>
		<h2>Інформація про навчальні предмети</h2>
		<form method='POST' action='http://localhost/myProfile/phpLabs/lab3/send.php'>
			<table  border="2" cellspacing="2" >
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
				  <td><input type='text' name='name' placeholder='Введіть предмет' required></td>
				  <td><input type='number' name='semester' placeholder='Введіть номер' min="1" required></td>
				  <td><input type='number' name='hour' placeholder='Введіть годину' min="1" required></td>
				  <td><input type='text' name='formControl' placeholder='Введіть контроль' required></td>
				  <td><input type='text' name='pib' placeholder='Введіть ПІБ' required></td>
				</tr>

				<tr>
					<td colspan="5"><input type="submit" name="submit" id="submit" value="Відправити"></td>
				</tr>	
			</table>
			<?php 
				$a = sizeof(array_count_values(array_column($twoArr, 4)));
			  	echo "Усього лекторів: \r\n" . $a;
			 ?>	 
		</form>	 		 
</body>
</html>

