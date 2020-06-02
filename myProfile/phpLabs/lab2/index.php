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
	<title>Lab2 File</title>
	<link rel="stylesheet" href="assets/css/css.css?v=8">
</head>
<body>
		<h2>Інформація про навчальні предмети</h2>
		<form method='POST' action='send.php'>
			<table  border="2" cellspacing="2" >
				<tr>
					<th>Предмет</th>
					<th>Семестр</th>
					<th>Години</th>
					<th>Форма контролю</th>
					<th>ПІБ</th>
				</tr>

				<?php
					while(!feof($file)) :
				  		$str = fgets($file);
				  		$arr = explode(";", $str);
				  		//array_pop($arr); //останній елемент відкидає

				?>
				  		<tr>
				  		<?php foreach ($arr as $value) : ?>
						    <td><?=$value?></td>
						<?php endforeach; ?>
						</tr>	
				  	<?php endwhile; ?>

				<tr>
				  <td><input type='text' name='name' placeholder='Введіть предмет' required></td>
				  <td><input type='number' name='semester' placeholder='Введіть номер' min="1" required></td>
				  <td><input type='number' name='hour' placeholder='Введіть годину' min="1" required></td>
				  <td><input type='text' name='formControl' placeholder='Введіть контроль' required></td>
				  <td><input type='text' name='pib' placeholder='Введіть ПІБ' required></td>
				</tr>

				<tr>
					<th><input type="submit" name="submit" id="submit" value="Відправити"></th>
				</tr>
			</table>
		</form>	 
</body>
</html>

