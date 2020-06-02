<?php 
	date_default_timezone_set('Europe/Kiev');
	$nowDate = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Lab8 Date</title>
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
	</style>
</head>
<body style="text-align: center;">
	<p style="font-weight: bold; font-size: 20px;">Виберіть бажану дату</p>

	<form method="POST" action="index.php">
		<input type="date" name="date" value="<?= $nowDate ?>">
		<input type="submit" name="submit" value="Натисніть тут">
	</form>
</html>
</body>

<?php  	
	if(isset($_POST["submit"]) && $_POST["date"] != "") {
		$date = new DateTime($_POST["date"]);
		$nextYear = (int)$date->format('Y') + 1;

		$nextY = new DateTime("{$nextYear}-01-01");
		$end = $date->diff($nextY);
		$endDate = $end->format('%R%a');
		
		echo "<div class='days'><p>З {$date->format('Y-m-d')} до {$nextY->format('Y-m-d')} </p></div>";
		echo "<div class='pday'><p>Кількість днів: {$endDate}</p></div>";
	}
?>
