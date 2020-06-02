<?php  
	require_once "../connect2/connect.php";
	require_once "classes/Author.php";
	require_once "classes/Biography.php";
	
	$authorId = $_GET["author_id"];
	//$authorId = 1;
	$Author = new Author();
	$authors = $Author->getById($authorId);
	$biografy = new Biography();


?>

<?php require_once "help_pages/header.php"; ?>

			<div class="menubar">
				<ul class="menu">
					<li class="selected"><a href="index.php?author_id=<?=$authorId?>">Головна</a></li>
					<li><a href="films.php?author_id=<?=$authorId?>">Документальні фільми</a></li>
					<li><a href="poems.php?author_id=<?=$authorId?>">Вірші</a></li>
					<li><a href="gallery.php?author_id=<?=$authorId?>">Альбом</a></li>
				</ul>
			</div>
		</div>

		<div class="site_content">

			<?php require_once "help_pages/sidebar.php"; ?>

			<div class="content">
				<div class="taras">
					<img src="assets/uploadsImagine/<?=$authors->getPhoto()?>">
					<p style="font-weight: bold; text-align: center; font-size: 20px;">
						<?="{$authors->getFirstName()} {$authors->getLastName()} {$authors->getSurname()}"?>
					</p>
					<?php foreach ($biografy->getBiographysForAuthorId($authorId) as $objBiografy) : ?>
						<p><?=$objBiografy->getText()?></p>
					<?php endforeach; ?>
				</div>	
			</div>
		</div>

		<?php require_once "help_pages/footer.php"; ?>
	</div>
</body>
</html>

