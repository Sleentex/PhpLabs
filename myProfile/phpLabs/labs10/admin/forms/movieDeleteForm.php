<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "../../../connect2/connect.php"; 
	require_once "../../classes/Movie.php";

	$movie = new Movie();

	if(isset($_GET["movie_id"])) {
		$movie->deleteById($_GET["movie_id"]);
	}

	header("Location: ../movies.php?author_id={$_GET['author_id']}");
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>