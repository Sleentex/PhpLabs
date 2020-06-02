<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Lab3 Array</title>
	<link rel="stylesheet" href="assets/css/css.css?v=2">
</head>
<body>
		<?php 
			$file = fopen('assets/documents/doc.txt', 'a');

			if(!$file) {
				die("Couldn`t open file!");
			}

			$line = "\r\n" . $_POST['name'] . ';' . $_POST['semester'] . ';' . $_POST['hour'] . ';' . 
			$_POST['formControl'] . ';' . $_POST['pib'] . ";";
		
			fwrite($file, $line);
		?>

		<?php header("Location: http://localhost/myProfile/phpLabs/lab3"); ?>
		<!-- <script type="text/javascript">
		  	window.location.href = "http://localhost/labs/lab3";
		 </script> --> 
</html>

