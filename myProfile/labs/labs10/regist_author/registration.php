<?php  
	$login = "";
	$name = "";
	if (isset($_GET["login"])) {
		$login = $_GET["login"];
	}
	if (isset($_GET["name"])) {
		$name = $_GET["name"];
	}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Форма реєстрація</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
	<h1 style="text-align: center; ">Форма реєстрації</h1>
	<form action="checkRegistration.php" method="POST" style="width: 500px; text-align: center; margin: auto;">
		<input type="text" class="form-control" value="<?=$login?>" name="login" id="login" placeholder="Введіть логін" required>
		<?php if(isset($_GET["errorL"]) && $_GET["errorL"] != "") : ?>
			<span style="float: left; color: red; font-size: 16px; padding-left: 1px;"><?=$_GET["errorL"]?></span>
		<?php else : ?>
			<br>
		<?php endif; ?>
		<input type="text" class="form-control" value="<?=$name?>" name="name" id="name" placeholder="Введіть ім'я" pattern="[А-Я-І][а-я-і]{2,}" required>
		<?php if(isset($_GET["errorN"]) && $_GET["errorN"] != "") : ?>
			<span style="float: left; color: red; font-size: 16px; padding-left: 1px;"><?=$_GET["errorN"]?></span>
		<?php else : ?>
			<br>
		<?php endif; ?>
		<input type="password" class="form-control" name="pass" id="pass" placeholder="Введіть пароль" required>
		<?php if(isset($_GET["errorP"]) && $_GET["errorP"] != "") : ?>
			<span style="float: left; color: red; font-size: 16px; padding-left: 1px;"><?=$_GET["errorP"]?></span>
		<?php else : ?>
			<br>
		<?php endif; ?>
		<button class="btn btn-success" type="submit" style="margin-top: 25px;">Зареєструвати</button>
		<a class="btn btn-primary" href="../index.php?author_id=1" role="button" style="margin-top: 25px;">На головну</a>
	</form>	
</body>
</html>