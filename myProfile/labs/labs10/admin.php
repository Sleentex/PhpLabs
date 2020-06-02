<?php 
	if(isset($_COOKIE['adminLogin'])) { 
 		header("Location: admin");  
 	}
 	$error = "";
	if (isset($_GET["error"]) && $_GET["error"] != "") {
		$error = $_GET["error"];
		$_GET["error"] = "";
	}
	$login = "";
	if (isset($_GET["login"]) && $_GET["login"] != "") {
		$login = $_GET["login"];
		$_GET["login"] = "";
	}
 ?>



 

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Вхід для адміна</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
	<h1 style="text-align: center; ">Вхід для адміна</h1>
	<form action="admin/checkAdmin.php" method="POST" style="width: 500px; text-align: center; margin: auto;">
		<input type="text" class="form-control" name="login" id="login" value="<?=$login?>" placeholder="Введіть логін" required><br>
		<input type="password" class="form-control" name="pass" id="pass" placeholder="Введіть пароль" required>
		<?php if($error != "") : ?>
			<span style="text-align: center; color: red; font-size: 16px; padding-left: 1px;"><?=$error?></span><br>
		<?php else : ?>
			<br>
		<?php endif; ?>
		<button class="btn btn-success" type="submit" name="submit">Вхід</button>
		<a class="btn btn-primary" href="index.php?author_id=1" role="button">На головну</a>
	</form>	
</body>
</html>


