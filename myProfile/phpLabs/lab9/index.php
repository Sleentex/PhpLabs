<?php 
	date_default_timezone_set('Europe/Kiev');
	$nowDate = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Lab9 Image</title>
	<style>
		body {
			width: 800px;
			margin: auto;
		}

		input[type="submit"] {
			height: 24px;
		}
		
		.pday {
			font-weight: bold; font-size: 20px;
		}

		.days {
			font-size: 20px;
		}

		img {
		  vertical-align: middle; 
		}
	</style>
</head>
<body style="text-align: center;">
	<p style="font-weight: bold; font-size: 20px;">Виберіть бажану дату</p>

	<form method="POST" action="index.php">
		<input type="date" name="date" value="<?= $nowDate ?>">
		<input type="submit" name="submit" value="Натисніть тут">
	</form>

	<?php require_once "check.php"; ?>
</html>
</body>