<?php  
	require_once "../connect2/connect.php";
	require_once "classes/Author.php";
	require_once "classes/Movie.php";
	
	$authorId = $_GET["author_id"];
	$Author = new Author();
	$authors = $Author->getById($authorId);
	$movie = new Movie();
	$movies = $movie->getMoviesForAuthorId($authorId);

?>

<?php require_once "help_pages/header.php"; ?>

			<div class="menubar">
				<ul class="menu">
					<li><a href="index.php?author_id=<?=$authorId?>">Головна</a></li>
					<li class="selected"><a href="films.php?author_id=<?=$authorId?>">Документальні фільми</a></li>
					<li><a href="poems.php?author_id=<?=$authorId?>">Вірші</a></li>
					<li><a href="gallery.php?author_id=<?=$authorId?>">Альбом</a></li>
				</ul>
			</div>
		</div>

		<div class="site_content">

			<?php require_once "help_pages/sidebar.php"; ?>
			
			<div class="content">
				<p style="text-align: center; font-size: 30px; font-weight: bold;">Фільми</p>
				<hr style="margin-bottom: 20px;">
				
				<?php foreach ($movies as $value): ?>
					<div class="info_film">
						<img src="assets/uploadsImagine/<?=$value->getPhoto()?>" alt="Foto">
						<p style=" font-size: 25px; font-weight: bold; padding-bottom: 15px;"><?=$value->getName()?></p>
						<?=$value->getVideoDescribe()?>
						<div class="button"><a href="showVideo.php?author_id=<?=$authorId?>&movie_id=<?=$value->getId()?>">Смотреть</a></div>
					</div>
				<?php endforeach ?>
			</div>
		</div>

		<?php require_once "help_pages/footer.php"; ?>
	</div>

	
</body>
</html>