<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>
<?php 
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Movie.php";
	require_once "../classes/Feedback.php";

	$movieId = $_GET['movie_id'];
	$movie = new Movie();
	$movie = $movie->getById($movieId);

	$feedbacks = new Feedback();
	$feedbacks = $feedbacks->getFeedbacksForMovieId($movieId);

	$error = "";
	if (isset($_GET["error"]) && $_GET["error"] != "") {
		$error = $_GET["error"];
		$_GET["error"] = "";
	}

?>

<style>
	.myTable input[type="file"] {
		width: auto;
		border: none;
		text-align: center;
		padding-left: 30px;
		padding-right: 1px;
	}

	.myTable img {
		width: 100px; 
		height: 140px;
		box-shadow: 3px 3px 3px #777;
	}
</style>

<div class="myTable">
	<form action="forms/movieUpdateForm.php" method="POST" enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="0">
			<input type="hidden" name="movie_id" value="<?=$movieId?>">
			<input type="hidden" name="author_id" value="<?=$_GET['author_id']?>">
			<th colspan="2" style="width: 500px; padding: 10px;">Автор</th>
			<tr>
				<td>
					<input type="text" name="name" value="<?=$movie->getName()?>" placeholder="Введіть назву фільма" style="width: 200px; margin: 10px;" required>
				</td>
				<td>
					<input type="text" name="video" value="<?=$movie->getVideo()?>" placeholder="Введіть силку фільма" style="width: 200px; margin: 10px;" required>
				</td>
			</tr>	
			<tr>
				<td colspan="2">
					<textarea name="describe" maxlength="250" placeholder="Введіть опис фільма" style="width: 800px; height: 100px;  margin: 10px;" required><?=$movie->getVideoDescribe()?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<img src="../assets/uploadsImagine/<?=$movie->getPhoto()?>" alt="Movie Foto"><br>
					<input type="file" name="fileToUpload"
					 <?php if($movie->getPhoto() == null) { echo "required"; } ?>
					  style="margin: 10px 0 10px 0;">
					 <br>	

					<span style="color: red; font-size: 15px; "><?=$error;?></span>
				</td>
			</tr>
			<tr><td colspan="2"><a href="feedbacks.php?movie_id=<?=$movieId?>">Відгуки фільма</a></td></tr>
			<tr><td colspan="2"><input type="submit" name="submit" value="Оновити" style="width: 300px; margin: 10px;"></td></tr>	
		</table>	
	</form>			
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

