<?php  
	require_once "../connect2/connect.php";
	require_once "classes/Author.php";
	require_once "classes/Gallery.php";
	
	$authorId = $_GET["author_id"];
	$Author = new Author();
	$authors = $Author->getById($authorId);
	$gallery = new Gallery();
?>

<?php require_once "help_pages/header.php"; ?>

			<div class="menubar">
				<ul class="menu">
					<li><a href="index.php?author_id=<?=$authorId?>">Головна</a></li>
					<li><a href="films.php?author_id=<?=$authorId?>">Документальні фільми</a></li>
					<li><a href="poems.php?author_id=<?=$authorId?>">Вірші</a></li>
					<li class="selected"><a href="gallery.php?author_id=<?=$authorId?>">Альбом</a></li>
				</ul>
			</div>
		</div>

		<div class="site_content">

			<?php require_once "help_pages/sidebar.php"; ?>

			<div class="content">
				<p style="text-align: center; font-size: 30px; font-weight: bold;">Альбом</p>
				<hr style="margin-bottom: 20px;">
				<div class="films_block">
				<?php foreach ($gallery->getGallerysForAuthorId($authorId) as $objGallery): ?>
					<img src="assets/uploadsImagine/<?=$objGallery->getPhoto()?>" class="image" alt="Foto" style="border-radius: 5px; width: 32%; height: 100%;">
				<?php endforeach ?>	
				</div>
			</div>
		</div>
		<?php require_once "help_pages/footer.php"; ?>
	</div>

	
</body>
</html>