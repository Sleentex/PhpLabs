<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Фильмы - про собак">
	<meta name="keywords" content="фильмы, ужасы, онлайн">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="assets/style.css">
</head>
<body>
	<div class="main">
		<div class="header">
			<div class="logo">
				<div class="logo_text">
					<h1><a href="#">Видатні поети</a></h1>
					<h2>Міняйте з умом <?=$_COOKIE['adminLogin']?></h2>
				</div>
			</div>

			<div class="menubar" style="float: right;">
				<ul class="menu" style="text-align: center;">
					<li><a href="index.php">Головна адмінка</a></li>
					<li><a href="../index.php?author_id=1">Користувач</a></li>
					<li><a href="exitAdmin.php">Вихід</a></li>
				</ul>
			</div>
		</div>