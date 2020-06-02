<?php  
	require_once "../connect2/connect.php";
	require_once "classes/Author.php";
	require_once "classes/Poem.php";
	
	$authorId = $_GET["author_id"];
	$Author = new Author();
	$authors = $Author->getById($authorId);
	$poem = new Poem();
	$poems = $poem->getPoemsForAuthorId($authorId);


?>

<?php require_once "help_pages/header.php"; ?>

			<div class="menubar">
				<ul class="menu">
					<li><a href="index.php?author_id=<?=$authorId?>">Головна</a></li>
					<li><a href="films.php?author_id=<?=$authorId?>">Документальні фільми</a></li>
					<li class="selected"><a href="poems.phpauthor_id=?<?=$authorId?>">Вірші</a></li>
					<li><a href="gallery.php?author_id=<?=$authorId?>">Альбом</a></li>
				</ul>
			</div>
		</div>
		
		<div class="site_content">

			<?php require_once "help_pages/sidebar.php"; ?>

			<div class="content">
				<p style="text-align: center; font-size: 30px; font-weight: bold; padding-bottom: 0px;">Вірші</p>
				<hr style="margin-bottom: 20px;">
				<?php foreach ($poems as $value) : ?>
					<a href="showPoem.php?author_id=<?=$authorId?>&poem_id=<?=$value->getId()?>">
						<p style="text-align: center; margin: 0px; padding: 0px;"><?= $value->getName()?></p>
					</a>
				<?php endforeach; ?>	
			</div>
		</div>

		<?php require_once "help_pages/footer.php"; ?>
	</div>
</body>
</html>