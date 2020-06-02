<?php  
	$error = "";
	if (isset($_GET["error"]) && $_GET["error"] != "") {
		$error = $_GET["error"];
		$_GET["error"] = "";
	}
?>

<div class="sidebar_container">
	<div class="sidebar">
		<?php if(!isset($_COOKIE['userName'])) : ?>
			<h2>Вхід</h2>
			<form method="POST" action="regist_author/authorization.php" id="login_form">
				<input type="hidden" name="author_id" value="<?=$authorId?>">
				<input type="text" name="login" placeholder="логін" required>
				<input type="password" name="pass" placeholder="пароль" required>
				<input type="submit" class="btn" value="увійти">
				<div class="lables_passreg_text">
					<span><a href="#">забули пароль?</a></span> | <span><a href="regist_author/registration.php">реєстрація</a></span>
				</div>
				<?php if($error != "") : ?>
					<span style="color: red; font-size: 13px; padding-left: 3px"><?=$error?></span>
				<?php endif; ?>
			</form>
		<?php else: ?>
			<h2 style="padding-bottom: 0;">Авторизовані</h2>
			<a href="regist_author/exit.php?author_id=<?=$authorId?>" style="float: right; padding-top: 16px;"><input type="submit" class="btn" value="вийти"></a>
			<p style="font-size: 15px; padding: 0;">Логін: <?=$_COOKIE['userLogin']?></p>
			<p style="font-size: 15px; padding: 0;">Ім'я: <?=$_COOKIE['userName']?></p>
		<?php endif;  ?>
	</div>

	<div class="sidebar">
		<h2>Поети</h2>
		<ul>
			<?php foreach ($Author->getAll() as $value): ?>
				<li><a href="index.php?author_id=<?=$value->getId()?>"><?=$value->getFirstName()." ".$value->getSUrname()?></a></li>
			<?php endforeach ?>
		</ul>
	</div>

	<?php  
		require_once "classes/Movie.php";

		$movies = new Movie();
		$movies = $movies->getMoviesForAuthorId($authorId);
	?>
	<?php if ($movies != null): ?>
		<div class="sidebar">
			<h2>Цікаві фільми</h2>
			<?php foreach ($movies as $value): ?>
				<ul>
					<li><a href="showVideo.php?author_id=<?=$authorId?>&movie_id=<?=$value->getId()?>"><?=$value->getName()?></a></li>
				</ul>
			<?php endforeach ?>
		</div>
	<?php endif ?>
	
</div>