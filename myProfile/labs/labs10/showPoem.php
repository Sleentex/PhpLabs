<?php  
	require_once "../connect2/connect.php";
	require_once "classes/Author.php";
	require_once "classes/Poem.php";
	
	$authorId = $_GET["author_id"];
	$poemId = $_GET["poem_id"];
	
	$Author = new Author();
	$authors = $Author->getById($authorId);
	$poem = new Poem();
	$poem = $poem->getById($poemId);
?>

<?php require_once "help_pages/header.php"; ?>

			<div class="menubar">
				<ul class="menu">
					<li><a href="index.php?author_id=<?=$authorId?>">Головна</a></li>
					<li><a href="films.php?author_id=<?=$authorId?>">Документальні фільми</a></li>
					<li class="selected"><a href="poems.php?author_id=<?=$authorId?>">Вірші</a></li>
					<li><a href="gallery.php?author_id=<?=$authorId?>">Альбом</a></li>
				</ul>
			</div>
		</div>
		
		
		<div class="site_content">

			<?php require_once "help_pages/sidebar.php"; ?>

			<div class="content">
				<p style="text-align: center; font-size: 30px; font-weight: bold; padding-bottom: 0px;"><?=$poem->getName()?></p>
				<hr style="margin-bottom: 20px;">
				<p style="text-align: center;"><?php echo str_replace("\r\n", "<br>", $poem->getText());?></p>
			</div>
		</div>

		<?php require_once "help_pages/footer.php"; ?>
	</div>
</body>
</html>