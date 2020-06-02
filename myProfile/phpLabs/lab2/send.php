<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Lab2 File</title>
	<link rel="stylesheet" href="assets/css/css.css?v=2">
</head>
<body>
		<?php 
			$file = fopen('assets/documents/doc.txt', 'a');

			if(!$file) {
				die("Couldn`t open file!");
			}

			$line = "\r\n" . $_POST['name'] . ';' . $_POST['semester'] . ';' . $_POST['hour'] . ';' . 
			$_POST['formControl'] . ';' . $_POST['pib'];
			fwrite($file, $line);
		?>

		 <h2>Характеристики Apple Iphone</h2>	 
<!-- header("location: ") -->
		<script type="text/javascript">
		 	window.location.href = "index.php";
		</script>
</body>
</html>

