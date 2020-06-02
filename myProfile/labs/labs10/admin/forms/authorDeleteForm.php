<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "../../../connect2/connect.php"; 
	require_once "../../classes/Author.php";

	$author = new Author();

	if(isset($_GET["author_id"])) {
		$author->deleteById($_GET["author_id"]);
	}

	header("Location: ../");
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>