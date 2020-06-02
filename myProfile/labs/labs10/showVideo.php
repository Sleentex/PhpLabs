<?php  
	require_once "../connect2/connect.php";
	require_once "classes/Author.php";
	require_once "classes/Movie.php";
	require_once "classes/Feedback.php";
	require_once "classes/User.php";
	
	$authorId = $_GET["author_id"];
	$movieId = $_GET["movie_id"];
	
	$Author = new Author();
	$authors = $Author->getById($authorId);
	$movie = new Movie();
	$movie = $movie->getById($movieId);
	$feedbacks = new Feedback();
	$feedbacks = $feedbacks->getFeedbacksForMovieId($movieId);
	$user = new User();

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
				<p style="text-align: center; font-size: 30px; font-weight: bold;"><?=$movie->getName()?></p>
				<hr style="margin-bottom: 20px;">

				<iframe width="560" height="315" src="<?=$movie->getVideo()?>" frameborder="0" allowfullscreen></iframe>
				<div class="info_film_page">
					<!-- <span class="label">рейтинг: </span><span class="value">8.1 / 10</span>
					<span class="label">год: </span><span class="value">2014</span>
					<span class="label">режиссер: </span><span class="value">Кристиан Морараш</span> -->
				</div>
				
				<hr>
				<h2>Опис фільму "<?=$movie->getName()?>"</h2>

				<div class="description_film">
					<img src="assets/uploadsImagine/<?=$movie->getPhoto()?>" alt="Foto" style="height: 25vh;">
					<?=$movie->getVideoDescribe()?>
				</div>

				<hr>
				<h2>Відгуки про фільм</h2>
				<div class="reviews">
					<?php foreach ($feedbacks as $value): ?>
						<div class="review_name">
							<?php 
								$user = $user->getById($value->getUser()); 
								echo $user->getLogin();
							?>
						</div>
						<div class="review_text">
							<?=$value->getFeedback();?>
						</div>
					<?php endforeach ?>
				</div>
				
				<div class="send">
				<?php if(!isset($_COOKIE['userName'])) : ?>
					<textarea name="feedback" style="resize: none;" readonly placeholder="Авторизуйесь щоб написати відгук!"></textarea>
					<input type="submit" value="отправить">
				<?php else : ?>
					<form method="POST" action="forms/feedbackInsert.php" id="review">
						<input type="hidden" name="author_id" value="<?=$authorId?>">
						<input type="hidden" name="user_id" value="<?=$_COOKIE['userId']?>">
						<input type="hidden" name="movie_id" value="<?=$movieId?>">
						<textarea name="feedback" style="resize: none;" required></textarea>
						<input type="submit" name="submit" value="отправить" style="cursor: pointer;">
					</form>
				<?php endif; ?>
				</div>
				
			</div>
		</div>

		<?php require_once "help_pages/footer.php"; ?>
	</div>

	
</body>
</html>

