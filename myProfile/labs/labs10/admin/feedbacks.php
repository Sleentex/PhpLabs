<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>
<?php 
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Movie.php";
	require_once "../classes/Feedback.php";
	require_once "../classes/User.php";

	$movieId = $_GET['movie_id'];
	$movie = new Movie();
	$movie = $movie->getById($movieId);

	$feedbacks = new Feedback();
	$feedbacks = $feedbacks->getFeedbacksForMovieId($movieId);

	$user = new User();

	$error = "";
	if (isset($_GET["error"]) && $_GET["error"] != "") {
		$error = $_GET["error"];
		$_GET["error"] = "";
	}

?>

<div class="myTable">
		<table cellspacing="0" cellpadding="0">
			<th style="width: 500px; padding: 10px;">Відгуки</th>
			<?php foreach ($feedbacks as $value): ?>
					<input type="hidden" name="movie_id" value="<?=$movieId?>">
					<input type="hidden" name="feedback_id" value="<?=$value->getId()?>">
					<tr>
						<td>
							<?php $user = $user->getById($value->getUser()); ?>
							<p style="padding-bottom: 0px; text-align: left;"><?=$user->getLogin();?></p>
							<form action="forms/feedbackUpdate.php" method="POST">
								<input type="hidden" name="movie_id" value="<?=$movieId?>">
								<input type="hidden" name="feedback_id" value="<?=$value->getId()?>">
								<textarea name="feedback" maxlength="350" placeholder="Введіть опис фільма" style="width: 739px; height: 39px; float: left; margin: 0px; padding: 0px;" required><?=$value->getFeedback()?></textarea>
								<button style="float: left; margin-left: 2px; padding: 3px;" onclick="return confirm('Ви дійсно хочете оновити це?');"><img src="../assets/img/btnUpdate.png" alt="update" style="width: 30px; height: 30px;"></button>
							</form>

							<form action="forms/feedbackDeleteForm.php" method="POST">
								<input type="hidden" name="movie_id" value="<?=$movieId?>">
								<input type="hidden" name="feedback_id" value="<?=$value->getId()?>">
								<button style="padding: 3px;" onclick="return confirm('Ви дійсно хочете видалити це?');"><img src="../assets/img/btnDelete.png" alt="delete" style="width: 30px; height: 30px; float: left; "></button>
							</form>
						</td>
					</tr>
			<?php endforeach ?>

			<tr>
				<td><a href="movieUpdate.php?movie_id=<?=$movieId?>"><input type="submit" name="submit" value="Назад" style="width: 300px; margin: 10px;"></a></td>
			</tr>	
		</table>			
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

