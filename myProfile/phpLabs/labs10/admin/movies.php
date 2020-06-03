<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>

<?php 
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Movie.php";
	$authorId = $_GET['author_id'];
	$movie = new Movie();
	$movies = $movie->getMoviesForAuthorId($authorId);
?>

<div class="myTable">
		<table cellspacing="0" cellpadding="0">
			<th style="width: 500px;">Фільми</th>
				<th colspan="2">
					<a href="movieInsert.php?author_id=<?=$authorId?>">
						<input type="submit" value="Добавити" style="width: 300px; margin: 10px; ">
					</a>
				</th>
				<?php foreach ($movies as $value) : ?>
					<tr>
					<td>
						<a href="#">
							<?=$value->getName()?>
						</a>
					</td>
					<!-- <input type="hidden" name="author_id" value="<?=$_GET['author_id']?>"> -->
					<td>
						<a href="movieUpdate.php?author_id=<?=$authorId?>&movie_id=<?=$value->getId()?>">
							<input type="submit" value="Оновити">
						</a>
					</td>
					<td>
						<a href="forms/movieDeleteForm.php?author_id=<?=$authorId?>&movie_id=<?=$value->getId()?>">
							<input type="submit" name="delete_<?=$value->getId()?>" value="Видалити" onclick="return confirm('Ви дійсно хочете видалити це?');">
						</a>
					</td>
					</tr>	
				<?php endforeach; ?>
			
		</table>				
</div>



<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

