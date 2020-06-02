<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?php echo "{$authors->getFirstName()} {$authors->getLastName()}" ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Життя українських письменників">
	<meta name="keywords" content="поети, письменники, україна, автор, вірші, українські">
	<SCRIPT type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></SCRIPT>
	<script type="text/javascript" src="assets/js/javascript.js"></script>
	<link rel="stylesheet" href="assets/css/stylePhoto.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="main">
		<div class="header">
			<div class="logo">
				<div class="logo_text">
					<h1><a href="index.php?author_id=<?=$authorId?>">Видатні поети</a></h1>
					<h2><?php echo "{$authors->getFirstName()} {$authors->getLastName()} {$authors->getSurname()}"?></h2>
				</div>
			</div>